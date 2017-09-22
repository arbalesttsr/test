<?php

class DefaultController extends Controller
{
    public function init()
    {
//            $this->menu=array(
//                array('label'=>'Ldap Manage', 'url'=>array("/{$this->module->id}/ldapSettings/admin")),
//                array('label'=>'Create Ldap config', 'url'=>array("/{$this->module->id}/ldapSettings/create")),
//                array('label'=>'User Ldap Relation', 'url'=>array("/{$this->module->id}/userLdapRelation/admin")),
//            );
    }

    public function actionAdministration()
    {
        //Yii::app()->getModule('User/LoginAD')->ldap;
        $this->render('administration');
    }

}