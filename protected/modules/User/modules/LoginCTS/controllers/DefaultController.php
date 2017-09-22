<?php

class DefaultController extends Controller
{
    public $layout = 'main';

    public function actionAdministration()
    {
        //$test = Yii::app()->getModule('User/LoginCTS')->cts;
        //die(var_dump($test));
        $this->render('administration');
//          $test = Yii::app()->getModule('User/LoginCTS')->cts;
    }

    public function actionIndex()
    {
        die('test');
    }
}