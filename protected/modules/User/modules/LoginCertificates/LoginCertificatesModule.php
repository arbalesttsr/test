<?php

class LoginCertificatesModule extends CWebModule
{
    public $applicationLayout = 'main';
    public $openssl = array();
    public $front_tiles = array();

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        //Yii::app()->theme = 'user_theme';
    }

//	public function beforeControllerAction($controller, $action) {
//		
//		if(parent::beforeControllerAction($controller, $action)) {
//			// this method is called before any module controller action is performed
//			// you may place customized code here
//
//			if (Yii::app()->user->isGuest &&  !in_array(Yii::app()->request->pathinfo, array('User/site/login','User/default/installation','User/site/recoveryPassword','User/site/register','User/profile/create'))) {
//				Yii::app()->user->loginRequired();
//			} else {
//				return true;
//			}
//		} else {
//			return false;
//		}
//	}
}
