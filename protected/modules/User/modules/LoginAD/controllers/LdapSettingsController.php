<?php

class LdapSettingsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return LdapSettings the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = LdapSettings::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new LdapSettings;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['LdapSettings'])) {
            $model->attributes = $_POST['LdapSettings'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
//die(var_dump($usr));
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['LdapSettings'])) {
            $model->attributes = $_POST['LdapSettings'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('LdapSettings');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new LdapSettings('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['LdapSettings']))
            $model->attributes = $_GET['LdapSettings'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGetLdapUsername()
    {
        //die(var_dump($_POST));
        if (isset($_POST['name'])) {
            $login = $_POST['name'];
            $user = User::model()->findByAttributes(array('id' => $login));

            if (!is_null($user))
                die($user->ad_username);
            else
                die('Not Set');
        }
    }

    public function actionImportUserAd()
    {
        $model = new ImportUsersAD();
        $auth = Yii::app()->getAuthManager();
        $user_model = new User;
        if (Yii::app()->getUser()->isSa()) {
            $roles = $user_model->getRoles();
        } else {
            $roles = $user_model->getRoles(Yii::app()->getUser()->getId());
        }
        $message = '';
        if (isset($_POST['ImportUsersAD'])) {
            $model->attributes = $_POST['ImportUsersAD'];
            $response = HelperLoginAd::GetLdapUsers($model->userAd, $model->passwordAd, $model->ldap_setting);
            if (!empty($response) && count($response) > 1) {
                $this->render('ad_users_list', array(
                    'accounts' => $response,
                    'role' => $model->role,
                ));
            } else {
                $message = $response;
                $this->render('_importAd', array(
                    'model' => $model,
                    'message' => $message,
                    'roles' => $roles
                ));
            }
        } else {
            $this->render('_importAd', array(
                'model' => $model,
                'message' => $message,
                'roles' => $roles
            ));
        }

    }

    public function actionRegisterNewUsers()
    {
        if (isset($_POST)) {
            $array_ldap_data = array();
            $array_ldap_data = $_POST['ldapdata'];
            $role = $_POST['role'];
            $imported = 0;
            $not_imported = 0;
            foreach ($array_ldap_data as $one_row) {
                $ad = explode('|', $one_row);

                //$import_mod = ImportUsersAD::CheckInUserAdUsername($ad[0]);
                $u_mod = User::model()->findByAttributes(array('ad_username' => $ad[0]));
                if (!$u_mod) {
                    $model = new User();
                    $model->ad_username = $ad[0];
                    $usr_mod = User::model()->findByAttributes(array('username' => $ad[0]));
                    if ($usr_mod) {
                        //$model->update(array('condition'=>"your_conditions",$attributes));
                        $usr_mod->ad_username = $ad[0];
                        if ($usr_mod->save())
                            $imported++;
                    } else {
                        $model = new User();
                        $model->ad_username = $ad[0];
                        $model->username = $ad[0];
                        $model->password = '123qweASD';
                        $model->passwordCompare = '123qweASD';
                        if ($model->save()) {
                            $auth = Yii::app()->getAuthManager();
                            $auth->assign($role, $model->id);
                            $imported++;
                        }
                    }

                } else {
                    $not_imported++;
                }


            }

            $result = 'Utilizatori Importati : ' . $imported . ' , nu s-au importat : ' . $not_imported . ' utilizatori';
            die($result);
        } else {
            die('nu sunt date in post');
        }
    }

    public function actionListAdUsers()
    {
        $result = HelperLoginAd::GetLdapUsers();
        if (empty($result)) {
            $result = array();
        }
        if ($addPassword && $addUser && $addDepartment && $addRole) {
            $accounts = HelperImportADUsers::getADUsers($addUser, $addPassword);

            if ($accounts) {
                foreach ($accounts as $key => $value) {
                    $accounts [$key] ['id'] = $key;
                    $accounts [$key] ['department'] = $addDepartment;
                    $accounts [$key] ['role'] = $addRole;

                    $criteriaUser = new CDbCriteria ();
                    $criteriaUser->compare('username', $value ['login']);

                    $criteriaLogin = new CDbCriteria ();
                    $criteriaLogin->addSearchCondition('username', $value['login']);
                    $criteriaLogin->addCondition('type_id = ' . LoginType::ACTIVE_DIRECTORY);

                    $accounts [$key] ['duplicate'] = User::model()->exists($criteriaUser) || ActiveLoginType::model()->exists($criteriaLogin);

                    if ($accounts [$key] ['duplicate'])
                        unset ($accounts [$key]);
                }


                $dataProvider = new CArrayDataProvider ($accounts, array(
                    'sort' => array(
                        'attributes' => array(
                            'last_name',
                            'first_name',
                            'login',
                            'email',
                            'department',
                            'role'
                        )
                    ),
                    'pagination' => array(
                        'pageSize' => count($accounts)
                    )
                ));
            } else {
                $dataProvider = array();
                $noAccounts = true;
            }
        } else
            $dataProvider = array();

        $this->render('ad_users_list', array(
            'accounts' => $result
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param LdapSettings $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ldap-settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
