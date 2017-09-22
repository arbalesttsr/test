<?php

class UserModule extends CWebModule
{
    public $applicationLayout = 'main';
    public $applicationLogin = 'login';
    public $loginUrl = array('/User/site/login');
    public $homeUrl;
    public $loginMethods = array();
    public $tablePrefix = 'adm';
    public $front_tiles = array();
    public $fieldTypes = array(
        'textField' => 'textField',
        'textArea' => 'textArea',
        'dateField' => 'dateField',
        'dropDownList' => 'dropDownList',
        'numberField' => 'numberField',
        'checkBox' => 'checkBox',
    );

    public $dbTypes = array(
        'INT' => 'INT',
        'TINYINT' => 'TINYINT',
        'DECIMAL' => 'DECIMAL',
        'VARCHAR' => 'VARCHAR',
        'TEXT' => 'TEXT',
        'ENUM' => 'ENUM',
        'DATE' => 'DATE',
        'FROM_ANOTHER_TABLE' => 'FROM_ANOTHER_TABLE',
    );

    public $indexes = array(
        'INDEX' => 'INDEX',
        'FULLTEXT' => 'FULLTEXT',
    );

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        //Yii::app()->theme = 'user_theme';
    }

    public function beforeControllerAction($controller, $action)
    {

        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here

            if (Yii::app()->user->isGuest && !in_array(Yii::app()->request->pathinfo, array('User/site/loginMpass', 'User/site/loginDb', 'User/site/login', 'User/site/loginAjax', 'User/default/installation', 'User/site/recoveryPassword', 'User/site/register', 'User/profile/create'))) {
                Yii::app()->user->loginRequired();
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
