<?php

class ClientController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

     /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $user = new Client('search');
        $user->unsetAttributes();  // clear any default values
        if (isset($_GET['Client'])) {
            $user->attributes = $_GET['Client'];
        }
        $this->render('admin', array(
            'user' => $user,
        ));
    }

    public function actionActivateUser($id)
    {
        if ($id !== Client::SA_ID) {
            $user_model = $this->loadModel($id);
            if ($user_model) {
                $user_model->updateByPk($id, array('status_id' => 1));
                $user_model->updateByPk($id, array('penalization' => null));
            }
        }
        $this->redirect(array('admin'));
    }

    public function actionBlockUser($id)
    {

        if ($id !== Client::SA_ID) {
            $user_model = $this->loadModel($id);
            if ($user_model) {
                $user_model->updateByPk($id, array('status_id' => 0));
            }
        }
        $this->redirect(array('admin'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Client::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDeleteSqlUser($id)
    {
            $model = $this->loadModel($id);

            $model->updateByPk($id, array('sql_user' => 0));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('/User/user/adminCliSqlUser'));
    }

    public function actionSetSqlUser($id)
    {
            $model = $this->loadModel($id);

            $model->updateByPk($id, array('sql_user' => 1));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(array('/User/user/adminCliSqlUser'));
    }

    public function actionUserDetailsUpdate($id)
    {

        // $user_model = $this->loadModel($id);
        $auth = Yii::app()->getAuthManager();
        //die(var_dump($auth));
        $user_model = $this->loadModel($id);
        $user_model->role = "Client";
        $profile_model = ClientProfile::model()->findByPk($id);
        $additionalProfileModel = ClientProfileAdditional::model()->findByPk($id);

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);

        if (isset($_POST['Client'])) {
            $user_model->attributes = $_POST['Client'];
            $id_user = $user_model->id;
            $idnp = $user_model->idnp;
            if ($user_model->save()) {

                $user = ClientProfile::model()->findByAttributes(array('user_id' => $id_user));
                $user->idnp = $idnp;
                $user->update();
                try{
                    $auth->assign($user_model->role, $user_model->id);
                }catch(Exception $ex){}
                $this->redirect(array('userDetailsUpdate', 'id' => $id_user));
            }
        }
        //profil
        if (isset($_POST['ClientProfile'])) {
            $profile_model->attributes = $_POST['ClientProfile'];
            $profile_model->avatar = CUploadedFile::getInstance($profile_model, 'avatar');
            if ($profile_model->avatar) {
                $save_path = UserFilesManagerProvider::getAvatarsFolder();
                $save_file = 'avatar_' . md5($id) . '.' . $profile_model->avatar->extensionName;
                $profile_model->avatar->saveAs(($save_path . '/' . $save_file));
            }

            if ($profile_model->save())
                $this->redirect(array('userDetailsUpdate', 'id' => $id));//$this->r$thisedirect(array('view','id'=>$profile_model->id));
        }
        //profil aditional
        if (isset($_POST['ClientProfileAdditional'])) {
            $additionalProfileModel->attributes = $_POST['ClientProfileAdditional'];

            //die(var_dump($additionalProfile->attributes));
            if ($additionalProfileModel->save())
                $this->redirect(array('userDetailsUpdate', 'id' => $id));//$this->redirect(array('view','id'=>$profile_model->id));
        }
        //$this->render('update_user_new_form',array(
        // $this->render('update_user_profile',array(
        $this->render('update_user_details', array(
            'user_model' => $user_model,
            'profile_model' => $profile_model,
            'additionalProfileModel' => $additionalProfileModel,
            'fieldsConfig' => $fieldsConfig,

        ));
    }

    public function actionPassReset($id)
    {
        $passModel = new PasswordForm();
        $msg = '';
        $user_model = $this->loadModel($id);
        $model = $user_model->profile;

        if (isset($model->email) && isset($model->idnp)) {
                if (!$user_model->recoveryPassTime) {
                    $user_model->password = Client::model()->generateRandomPassword();
                    $user_model->passwordCompare = $user_model->password;
                    $user_model->password_hash = CPasswordHelper::hashPassword($user_model->password);
                    if ($user_model->isNewRecord && $user_model->save() || $user_model->update()) {
                        $email = $user_model->profile->email;
                        $to = $user_model->profile->firstname . ' ' . $user_model->profile->lastname . ' <' . $email . '>';
                        $content = "username: " . $user_model->username . "<br/>" . "password:" . $user_model->password;

                        if (SendMailHelper::sendMail($email, $model->email, 'Solicitare schimbare parola', $content)) {
                            $user_model->addRecoveryPass();
                        }
                    }
                }
        }

        $this->redirect(array('userDetailsUpdate', 'id' => $id));

    }

    private function updateDbSqlUser($user, $pass)
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = 'client';
        if ($tablePrefix !== 'client') {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $sql_username = $tablePrefix . '_' . $user . '_' . AP_DB_NAME;
                $user_table = Yii::app()->db->createCommand()
                    ->select('usename')
                    ->from('pg_catalog.pg_user u')
                    ->where('usename=:usename', array(':usename' => $sql_username))
                    ->queryRow();
                if ($user_table) {
                    Yii::app()->db->createCommand("select update_user('" . $sql_username . "','" . $pass . "');")->execute();
                }
                $transaction->commit();
                return true;
            } catch (Exception $e) {
                $transaction->rollback();
                return false;
            }
        }
    }

}