<?php

class SiteController extends Controller
{
    public $defaultAction = 'login';
    public $layout = 'login';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogout()
    {
        if (isset($_SESSION['SessionIndex'])) {

            $cts = new CtsAuth();

            if (isset($_POST['SAMLResponse'])) {
                if (!$cts->validateResponse($_POST['SAMLResponse'])) {
                    throw new CHttpException(400, $cts->getError());
                } else {
                    session_destroy();
                    Yii::app()->user->logout();
                    $this->redirect('/site');
                }
            }
            else
            {
                $cts->setCallbackUrl(Yii::app()->createAbsoluteUrl('User/site/login'));
                $cts->logoutInit();
                $this->render('logout', array(
                    'cts' => $cts,
                ));
            }
        } else {
            Yii::app()->user->logout();
            $this->redirect('/site');
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $redirect_url = '/site/index';
            $this->redirect($redirect_url);
        }

        $model = new LoginForm;

        $cts = new CtsAuth();
        $cts->setCallbackUrl(Yii::app()->createAbsoluteUrl('User/site/login'));
        $cts->loginInit();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            $model->privateKeyFile = CUploadedFile::getInstance($model, 'privateKeyFile');
            $penalization_minutes = isset($_POST['LoginForm']['username']) ? User::getUserPenalization($_POST['LoginForm']['username']) : 0;
            if (Yii::app()->user->isSa())
                $holiday = true;
            else
                $holiday = UserSettings::checkHolidayDateWork();

            //die(var_dump($holiday, !$penalization_minutes , $model->validate() , $model->login()));

            // validate user input and redirect to the previous page if valid
            if ($holiday && !$penalization_minutes && $model->validate() && $model->login()) {

                $redirect_url = '/site/index';
                $user_id = Yii::app()->user->id;
                $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
                $sql = "SELECT last_url FROM {$visitorTableName} WHERE user_id=:user_id";

                $result = Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->queryScalar();
                //die(var_dump($result));
                if ($result !== false)
                    $redirect_url = $result;

                $redir_array = explode('?', $redirect_url);
                if (count($redir_array) == 1)
                    $this->redirect($redirect_url);
                else {
                    $uri = array($redir_array[0]);
                    foreach (explode('&', $redir_array[1]) as $param) {
                        var_dump(explode('&', $redir_array[1]));
                        $param_array = explode('=', $param);
                        if (isset($param_array[0], $param_array[1]))
                            $uri[$param_array[0]] = $param_array[1];
                    }
                    $this->redirect($uri);
                }
            }


        }

        if (isset($_POST['SAMLResponse'])) {
            if (!$cts->validateResponse($_POST['SAMLResponse'])) {
                throw new CHttpException(400, $cts->getError());
            }
            $userData = $cts->getResponseData();
//                        if(empty($userData)){
//                            $response = base64_decode($_POST['SAMLResponse']);
//
//                            die(var_dump($response));
//                        }

            if ($model->ctsLogin($userData))
                $this->redirect(Yii::app()->user->returnUrl);

//                                //array(4) { ["IDNO"]=> string(13) "0972805185036"
//                                //["FirstName"]=> string(5) "Dorin"
//                                //["LastName"]=> string(8) "Griţcan"
//                                //["EmailAddress"]=> string(19) "euliancom@yahoo.com" }
        }

        // display the login form
        $this->render('login', array(
            'model' => $model,
            'cts' => $cts,
        ));
    }

    public function actionRegister()
    {
        //throw new CHttpException(404, 'Din pacate inregistrarea nu este posibila din afara sistemului CTS');
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->request->getBaseUrl(true));
        $this->layout = 'main';
        $model = new Profile;
        $model->user_id = 0;
        $error_messages = $success_messages = array();
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if ($model->validate()) {
                //vedem daca clientul a mai fost pe aici
                $tryProf = Profile::model()->findByAttributes(array('idnp' => $model->idnp));
                $tryUser = User::model()->findByAttributes(array('idnp' => $model->idnp));
                //die(var_dump('aici'));                  
                if (!is_null($tryProf) && !is_null($tryUser))
                    $this->redirect(array('recoveryPassword'));
                elseif (!is_null($tryUser) && is_null($tryProf)) {//die('aici');
                    //$model->addError('idnp', 'You don\'t have <strong>&euro;</strong> in your account.');
                    $error_messages[] = 'Idnp-ul Dvs. a fost gasit in sistem, contactati administratorul de sistem';
                    //Yii::app()->user->setFlash('idnp', 'Idnp-ul Dvs. a fost gasit in sistem, contactati administratorul de sistem');
                } else {
                    $user = new User;
                    $username = preg_replace('/[^\da-z]/i', '', $model->firstname) . '.' . preg_replace('/[^\da-z]/i', '', $model->lastname);
                    $num = 0;
                    while (!is_null(User::model()->findByAttributes(['username' => $username]))) {
                        $username = preg_replace('/[^\da-z]/i', '', $model->firstname) . '.' . preg_replace('/[^\da-z]/i', '', $model->lastname) . $num;
                        $num++;
                    }
                    $user->username = $username;
                    $user->password = $user->generateRandomPassword();
                    $user->passwordCompare = $user->password;
                    $user->idnp = $model->idnp;

                    //die(var_dump($user->username));
                    if ($user->save()) {

                        //adaugarea rolului pentru utilizator
                        //$auth = Yii::app()->getAuthManager();
                        //$role = 'Client';
                        //$auth->assign($role, $user->id);

                        $model->user_id = $user->id;
                        if ($model->save()) {
                            $email = $model->email;
                            $to = $model->firstname . ' ' . $model->lastname . ' <' . $email . '>';
                            $content = "username: " . $user->username . "<br/>" . "password:" . $user->password;

                            if (SendMailHelper::sendMail($email, $model->email, 'Ati creat cont nou cu succes', $content))
                                $success_messages[] = 'Contul Dvs. a fost creat cu succes, verificati adresa de email indicata la inregistrare pentru a vedea datele de acces la portal';
                            else
                                $success_messages[] = 'Contul Dvs. a fost creat cu succes, insa email-ul nu a fost trimis';
                        } else
                            User::model()->deleteByPk($user->id);
                        $this->redirect(array('User/site/login'));
                    }
                }
            } /*else
                    die(var_dump($model->getErrors()));*/
        }
        $this->render('register', array('model' => $model, 'success_messages' => $success_messages, 'error_messages' => $error_messages));
    }

    public function actionRecoveryPassword()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->request->getBaseUrl(true));
        }
        $this->layout = 'login';
        //die('test');
        $model = new Profile;
        $messages = array();
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            if (isset($model->email) && isset($model->idnp)) {
                if ($model->idnp == '')
                    $model->idnp = null;
                $exists_profile = Profile::model()->findByAttributes(array('idnp' => $model->idnp, 'email' => $model->email));
                if (is_null($exists_profile))
                    $messages[] = array('type' => 'danger', 'msg' => 'Nu s-a gasit in sistem nici un profil dupa datele indicate');
                else {
                    $exists_user = User::model()->findByAttributes(array('idnp' => $exists_profile->idnp));
                    if (is_null($exists_user)) $exists_user = new User;

                    if (!$exists_user->recoveryPassTime) {
                        $exists_user->password = User::model()->generateRandomPassword();
                        $exists_user->passwordCompare = $exists_user->password;
                        $exists_user->password_hash = CPasswordHelper::hashPassword($exists_user->password);
                        if ($exists_user->isNewRecord && $exists_user->save() || $exists_user->update()) {
                            $email = $exists_user->profile->email;
                            $to = $exists_user->profile->firstname . ' ' . $exists_user->profile->lastname . ' <' . $email . '>';
                            $content = "username: " . $exists_user->username . "<br/>" . "password:" . $exists_user->password;
                            //if(WorkFlowHelper::SendToMailClientInfo($exists_user->id,$content))
                            if (SendMailHelper::sendMail($email, $model->email, 'Solicitare schimbare parola', $content)) {
                                $exists_user->addRecoveryPass();
                                $messages[] = array('type' => 'info', 'msg' => 'Parola noua a fost trimisa pe email. Mergeti la <a href="' . $this->createUrl('login') . '">pagina de logare</a>');
                            }
                        } else
                            $messages[] = array('type' => 'danger', 'msg' => 'Parola nu a putut fi modificata');
                    } else $messages[] = array('type' => 'danger', 'msg' => 'Ati solicitat o modificare de parola. Asteptati ' . $exists_user->recoveryPassTime . ' minute.');
                }
            }
        }
        $this->render('recoveryPassword', array('model' => $model, 'messages' => $messages));
        //$model =
    }

    public function actionLoginAjax(){
        if (!Yii::app()->user->isGuest) {
            die(json_encode(['status'=>true, 'authenticated' => true, 'url'=>$this->createUrl('index')]));
        }

        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if($model->runAs == LoginForm::RUN_AS_USER){
                /*setcookie('_run_as', md5(STEP_RUN_AS . 'User' . STEP_RUN_AS), time() + 60 * 60 * 24 * 30, '/');
                define("AP_YII_UMODULE", 'User');
                define("AP_YII_NUMODULE", 'Client');*/
            } else {
                /*setcookie('_run_as', md5(STEP_RUN_AS . 'Client' . STEP_RUN_AS), time() + 60 * 60 * 24 * 30, '/');
                define("AP_YII_UMODULE", 'Client');
                define("AP_YII_NUMODULE", 'User');*/
            }
            $model->privateKeyFile = CUploadedFile::getInstance($model, 'privateKeyFile');
            $penalization_minutes = isset($_POST['LoginForm']['username']) ? User::getUserPenalization($_POST['LoginForm']['username']) : 0;
            if (Yii::app()->user->isSa())
                $holiday = true;
            else
                $holiday = UserSettings::checkHolidayDateWork();

            // validate user input and redirect to the previous page if valid
            if ($holiday && !$penalization_minutes && $model->validate() && $model->login()) {

                $redirect_url = '/site/index';
                $user_id = Yii::app()->user->id;
                $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
                $sql = "SELECT last_url FROM {$visitorTableName} WHERE user_id=:user_id";

                $result = Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->queryScalar();
                //die(var_dump($result));
                if ($result !== false)
                    $redirect_url = $result;

                $redir_array = explode('?', $redirect_url);
                if (count($redir_array) == 1)
                    die(json_encode(['status' => true, 'authenticated' => true, 'url' => $redirect_url]));
                else {
                    $uri = array($redir_array[0]);
                    $uri_params = [];
                    foreach (explode('&', $redir_array[1]) as $param) {
                        //var_dump(explode('&', $redir_array[1]));
                        $param_array = explode('=', $param);
                        if (isset($param_array[0], $param_array[1]))
                            $uri_params[$param_array[0]] = $param_array[1];
                    }
                    die(json_encode(['status' => true, 'authenticated' => true, 'url' => Yii::app()->createUrl($redir_array[0], $uri_params)]));
                }
            }
        } die(json_encode(['status'=>false, 'errors'=>$model->errors]));
    }
}







