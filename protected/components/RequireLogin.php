<?php

class RequireLogin extends CBehavior
{
    public function attach($owner)
    {
        $owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
    }

    public function handleBeginRequest($event)
    {
        //first condition for require login is if user is guest
        if (strpos(Yii::app()->request->pathinfo, '/') !== false || strlen(Yii::app()->request->pathinfo) <= 43)
            $pathinfo = Yii::app()->request->pathinfo;
        else {
            $pathinfo = Yii::app()->getSecurityManager()->decrypt(base64_decode(strtr(Yii::app()->request->pathinfo, '-_,', '+/=')));
        }

        if (Yii::app()->user->isGuest) {
            $require = true;
            //first check actions without params
            $exceptions = LoginException::model()->findAllByAttributes(array('type' => '1'));
            foreach ($exceptions as $exception) {
                if (strtolower($exception->action) == strtolower($pathinfo)) {
                    $require = false;
                    break;
                }
            }

            //second check actions with params
            if ($require) {
                $exceptions = LoginException::model()->findAllByAttributes(array('type' => '2'));
                foreach ($exceptions as $exception) {
                    if (strpos(strtolower($pathinfo), strtolower($exception->action)) !== false) {
                        $require = false;
                        break;
                    }
                }
            }

            if($pathinfo == '')
                $require = false;
            //if user is guest and request action hasn't exception, redirect user to login page
            if ($require)
                Yii::app()->user->loginRequired();
        } elseif(is_null(User::model()->findByPk(Yii::app()->user->id)))
            Yii::app()->user->logout();
        elseif (isset(Yii::app()->user->id) && !is_null(Yii::app()->user->id) && !Yii::app()->user->isSa()) {
            $model = User::model()->findByPk(Yii::app()->user->id);
            if (!is_null($model) && $model->sql_user !== 0) {
                $umodule = strtolower(AP_YII_UMODULE);
                $tablePrefix = $umodule == 'user' ? 'usr' : 'client';

                if ($tablePrefix === 'usr') {
                    $sql_username = $tablePrefix . '_' . Yii::app()->user->username . '_' . AP_DB_NAME;
                    $sql_pass = Yii::app()->user->password;
                } else {
                    $sql_username = $tablePrefix . '_' . AP_DB_NAME;
                    $sql_pass = md5(AP_DB_NAME . '!' . 'client');
                    //die(var_dump($sql_username,$sql_pass));
                }
                $user_table = Yii::app()->db->createCommand()
                    ->select('usename')
                    ->from('pg_catalog.pg_user u')
                    ->where('usename=:usename', array(':usename' => $sql_username))
                    ->queryRow();
                if ($user_table) {
                    $db = Yii::createComponent(array(
                        'class' => 'CDbConnection',
                        'connectionString' => 'pgsql:host=' . AP_DB_URL . ';port=5432;dbname=' . AP_DB_NAME,
                        'emulatePrepare' => true,
                        'username' => $sql_username,
                        'password' => $sql_pass,
                        'charset' => 'utf8',
                        'enableProfiling' => true,
                        'enableParamLogging' => true
                    ));

                    Yii::app()->setComponent('db', $db);
                }
            }
        }

    }
}
