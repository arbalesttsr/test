<?php

class UserController extends Controller
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
            'postOnly + delete', // we only allow deletion via SUBSIDIARY request
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
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Register a new user.
     */
    public function actionRegister()
    {

        $auth = Yii::app()->getAuthManager();
//        if (!$auth->isAssigned(User::ADMIN, Yii::app()->getUser()->getId()) and !Yii::app()->getUser()->isSa()) {
//            throw new CHttpException(403, Yii::t('yii', 'You are not authorized to perform this action.'));
//        }
        $model = new User;
        if (Yii::app()->getUser()->isSa()) {
            $roles = $model->getRoles();
        } else {
            $roles = $model->getRoles(Yii::app()->getUser()->getId());
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            //die(var_dump('<pre>',$model->id,'</pre>'));
            if ($model->save()) {
                if ($model->role !== '') {
                    $auth->assign($model->role, $model->id);
                }
                //die(var_dump($model->sql_user));
                if ($model->sql_user !== "0") {
                    $this->createDbSqlUser($model->username, $model->password_hash);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('register', array(
            'model' => $model,
            'roles' => $roles
        ));
    }

    private function createDbSqlUser($user, $pass)
    {
        $umodule = strtolower(AP_YII_UMODULE);

        $tablePrefix = $umodule == 'user' ? 'usr' : 'client';
        if ($tablePrefix !== 'client') {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $sql_username = $tablePrefix . '_' . $user . '_' . AP_DB_NAME;
                Yii::app()->db->createCommand("select create_user('" . $sql_username . "','" . $pass . "');")->execute();
                $transaction->commit();
                return true;
            } catch (Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
            {
                $transaction->rollback();
                return false;
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $auth = Yii::app()->getAuthManager();
        //die(var_dump($auth));
        $model = $this->loadModel($id);
        if (Yii::app()->getUser()->isSa()) {
            $roles = $model->getRoles();
        } else {
            $roles = $model->getRoles(Yii::app()->getUser()->getId());
        }
        $roles = array('revoke' => Yii::t('UserModule.t', 'Revoke Role')) + $roles;
        $role = $auth->getRoles($model->id);
        $model->role = key($role);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $id_user = $model->id;
            $idnp = $model->idnp;
            if ($model->save()) {
                $user = Profile::model()->findByAttributes(array('user_id' => $id_user));
                $user->idnp = $idnp;
                $user->update();
                if ($model->role !== 'revoke' and $model->role !== '') {
                    $auth->revoke(key($role), $model->id);
                    $auth->assign($model->role, $model->id);
                } elseif ($model->role === 'revoke') {
                    $auth->revoke(key($role), $model->id);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'roles' => $roles
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if ($id !== User::SA_ID) {
            $profile = Profile::model()->findByAttributes(array('user_id' => $id));
            if ($profile)
                $profile->delete();


            $profile_additional = ProfileAdditional::model()->findByAttributes(array('user_id' => $id));
            if ($profile_additional)
                $profile_additional->delete();


            $user_settings = UserSettings::model()->findByAttributes(array('user_id' => $id));
            if ($user_settings)
                $user_settings->delete();

            $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
            $sql = "DELETE FROM {$visitorTableName} WHERE user_id=:user_id";
            $result = Yii::app()->db->createCommand($sql)->bindValue(':user_id', $id)->queryScalar();

            //delete db sql user
            $this->deleteDbSqlUser($this->loadModel($id)->username);

            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else {
            throw new CHttpException(403, 'This user can\'t be deleted.');
        }

    }

    private function deleteDbSqlUser($user)
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = $umodule == 'user' ? 'usr' : 'client';
        if ($tablePrefix !== 'client') {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $sql_username = $tablePrefix . '_' . $user . '_' . AP_DB_NAME;
                Yii::app()->db->createCommand("select delete_user('" . $sql_username . "');")->execute();
                $transaction->commit();
                return true;
            } catch (Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
            {
                $transaction->rollback();
                return false;
            }
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $user = new User('search');
        $user->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $user->attributes = $_GET['User'];
        }
        $this->render('admin', array(
            'user' => $user,
        ));
    }

    /**
     * view user Details
     */
    public function actionUserDetails($id)
    {

        $user_model = $this->loadModel($id);
        $user_settings_model = UserSettings::model()->findByAttributes(array('user_id' => $id));
        $profile_model = Profile::model()->findByPk($id);
        $additionalProfileModel = ProfileAdditional::model()->findByPk($id);
        //$this->render('view_user_profile',array(
        $this->render('view_user_details', array(
            'user_model' => $user_model,
            'profile_model' => $profile_model,
            'additionalProfileModel' => $additionalProfileModel,
            'user_settings_model' => $user_settings_model,
        ));
    }

    /**
     * update user Details
     */
    public function actionUserDetailsUpdate($id)
    {

        // $user_model = $this->loadModel($id);
        $auth = Yii::app()->getAuthManager();
        //die(var_dump($auth));
        $user_model = $this->loadModel($id);
        if (Yii::app()->getUser()->isSa()) {
            $roles = $user_model->getRoles();
        } else {
            $roles = $user_model->getRoles(Yii::app()->getUser()->getId());
        }
        $roles = array('revoke' => Yii::t('UserModule.t', 'Revoke Role')) + $roles;
        $role = $auth->getRoles($user_model->id);
        $user_model->role = key($role);
        $profile_model = Profile::model()->findByPk($id);
        $additionalProfileModel = ProfileAdditional::model()->findByPk($id);

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);

        //user settings
        $user_settings_model = UserSettings::model()->findByAttributes(array('user_id' => $id));


        if (isset($_POST['User'])) {
            $user_model->attributes = $_POST['User'];
            $id_user = $user_model->id;
            $idnp = $user_model->idnp;
            if ($user_model->save()) {

                $user = Profile::model()->findByAttributes(array('user_id' => $id_user));
                $user->idnp = $idnp;
                $user->update();
                if ($user_model->role !== 'revoke' and $user_model->role !== '') {
                    $auth->revoke(key($role), $user_model->id);
                    $auth->assign($user_model->role, $user_model->id);
                } elseif ($user_model->role === 'revoke') {
                    $auth->revoke(key($role), $user_model->id);
                }
                $this->redirect(array('userDetailsUpdate', 'id' => $id_user));
            }
        }
        //profil
        if (isset($_POST['Profile'])) {
            $profile_model->attributes = $_POST['Profile'];
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
        if (isset($_POST['ProfileAdditional'])) {
            $additionalProfileModel->attributes = $_POST['ProfileAdditional'];

            //die(var_dump($additionalProfile->attributes));
            if ($additionalProfileModel->save())
                $this->redirect(array('userDetailsUpdate', 'id' => $id));//$this->redirect(array('view','id'=>$profile_model->id));
        }
        //user settings
        if (isset($_POST['UserSettings'])) {
            $user_settings_model->attributes = $_POST['UserSettings'];
            if ($user_settings_model->save())
                $this->redirect(array('userDetailsUpdate', 'id' => $id));//$this->redirect(array('view','id'=>$model->id));
        }
        //$this->render('update_user_new_form',array(
        // $this->render('update_user_profile',array(
        $this->render('update_user_details', array(
            'user_model' => $user_model,
            'roles' => $roles,
            'profile_model' => $profile_model,
            'additionalProfileModel' => $additionalProfileModel,
            'fieldsConfig' => $fieldsConfig,
            'user_settings_model' => $user_settings_model,

        ));
    }

    public function actionActiveAllUsers()
    {
        if (Yii::app()->user->isSa()) {
            $users = User::model()->findAllByAttributes(array('status_id' => 0));
            if ($users !== null) {
                foreach ($users as $value) {
                    $user_model = $this->loadModel($value->id);
                    if ($user_model) {
                        $user_model->updateByPk($value->id, array('status_id' => 1));
                    }
                }
            }
            $this->redirect(array('admin'));
        } else {
            die('Nu aveti dreptul pentru aceasta actiune !!!');
        }
    }

    public function actionBanAllUsers()
    {
        if (Yii::app()->user->isSa()) {
            $users = User::model()->findAllByAttributes(array('status_id' => 1));
            if ($users !== null) {
                foreach ($users as $value) {
                    if ($value->id !== (int)User::SA_ID) {
                        $user_model = $this->loadModel($value->id);
                        if ($user_model) {
                            $user_model->updateByPk($value->id, array('status_id' => 0));
                        }
                    }
                }
            }
            $this->redirect(array('admin'));
        } else {
            die('Nu aveti dreptul pentru aceasta actiune !!!');
        }
    }

    public function actionActivateUser($id)
    {
        if ($id !== User::SA_ID) {
            $user_model = $this->loadModel($id);
            if ($user_model) {
                $user_model->updateByPk($id, array('status_id' => 1));
            }
        }
        $this->redirect(array('admin'));
    }

    public function actionBlockUser($id)
    {

        if ($id !== User::SA_ID) {
            $user_model = $this->loadModel($id);
            if ($user_model) {
                $user_model->updateByPk($id, array('status_id' => 0));
            }
        }
        $this->redirect(array('admin'));
    }

    public function actionPassReset($id)
    {
        $passModel = new PasswordForm();
        $msg = '';
        if ($id !== User::SA_ID) {
            if (isset($_POST['PasswordForm'])) {
                $passModel->attributes = $_POST['PasswordForm'];
                $user_model = $this->loadModel($id);
                if ($user_model) {
                    $new_password_hash = CPasswordHelper::hashPassword($passModel->newPassword);
                    $user_model->updateByPk($id, array('password_hash' => $new_password_hash,
                        'update_user_id' => is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId(),
                        'update_datetime' => date("Y-m-d H:i:s")
                    ));
                    //update db sql password
                    $this->updateDbSqlUser($user_model->username, $new_password_hash);
                    Yii::app()->user->setFlash('success', 'Password was changed successfully.');
                }
            }
        } else {
            if ($id === User::SA_ID)
                $msg = 'You can not reset password for \'sa\' user,  you can do only change action. ';//Yii::app()->user->setFlash('success', 'You can not reset password for \'sa\' user  only change. ');

        }
        $this->render('pass_reset', array('model' => $passModel, 'msg' => $msg));

    }

    private function updateDbSqlUser($user, $pass)
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = $umodule == 'user' ? 'usr' : 'client';
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

    public function actionAdminSqlUser()
    {

        $user = new User('search');
        $user->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $user->attributes = $_GET['User'];
        }
        $this->render('admin_sql_users', array('user' => $user,));

    }

    public function actionAdminCliSqlUser()
    {
        $user = new Client();
        $user->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $user->attributes = $_GET['User'];
        }
        if (User::GetCliDbSqlUsername() !== "Not Set") {
            $client_sql_user = 1;
        } else {
            $client_sql_user = 0;
        }
        //die(var_dump('<pre>',$dataProvider->getData(),'</pre>'));
        $this->render('admin_cli_sql_users', array('user' => $user, 'client_sql_user' => $client_sql_user));
    }

    public function actionClientDbSqlCreate()
    {

        $tablePrefix = 'client';
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $sql_username = $tablePrefix . '_' . AP_DB_NAME;
            $sql_pass = md5(AP_DB_NAME . '!' . $tablePrefix);
            Yii::app()->db->createCommand("select create_user('" . $sql_username . "','" . $sql_pass . "');")->execute();
            $transaction->commit();
            $this->redirect(array('adminCliSqlUser'));
        } catch (Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
        {
            $transaction->rollback();
            return false;
        }
    }

    public function actionDeleteClientDbSql()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $sql_username = 'client_' . AP_DB_NAME;
            Yii::app()->db->createCommand("select delete_user('" . $sql_username . "');")->execute();
            $transaction->commit();
            $this->redirect(array('adminCliSqlUser'));
        } catch (Exception $e) // в случае возникновения ошибки при выполнении одного из запросов выбрасывается исключение
        {
            $transaction->rollback();
            return false;
        }
    }

    public function actionCreateSqlUser($id)
    {
        $user_model = $this->loadModel($id);
        $this->createDbSqlUser($user_model->username, $user_model->password_hash);
        //$user_model->updateByPk($id, array('sql_user'=>1));
        $this->redirect(array('adminSqlUser'));
    }

    public function actionActivateSqlUser($id)
    {
        $user_model = $this->loadModel($id);
        $user_model->updateByPk($id, array('sql_user' => 1));
        $this->redirect(array('adminSqlUser'));
    }

    public function actionDisableSqlUser($id)
    {
        $user_model = $this->loadModel($id);
        $user_model->updateByPk($id, array('sql_user' => 0));
        $this->redirect(array('adminSqlUser'));
    }

    public function actionDeleteSqlUser($id)
    {
        if ($id !== User::SA_ID) {
            $model = $this->loadModel($id);

            $this->deleteDbSqlUser($model->username);
            $model->updateByPk($id, array('sql_user' => 0));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function actionUnlockPenalization($id)
    {
        $user_model = $this->loadModel($id);
        $user_model->updateByPk($id, array('penalization' => null));
        $this->redirect(array('userDetails', 'id' => $id));
    }

    public function actionSettingsReset($id)
    {
        $user_setting = UserSettings::model()->findByPk($id);
        $user_setting->updateByPk($id, array('time_limit' => 0,
            'restricted_id' => 0,
            'restricted_days' => NULL,
            'restricted_date' => NULL,
            'restricted_interval' => NULL,
            'date_start' => NULL,
            'start_time' => NULL,
            'end_time' => NULL,
            'holiday_enable' => 0,
            'update_user_id' => Yii::app()->getUser()->getId(),
            'update_datetime' => date("Y-m-d H:i:s")
        ));
        $this->redirect(array('userDetails', 'id' => $id));
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


}