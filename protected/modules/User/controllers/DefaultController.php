<?php

class DefaultController extends Controller
{
    public $layout = 'main';

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

    public function actionAdministration()
    {
        $this->render('administration');
    }

    public function actionGetRbamIframe()
    {
        //die(var_dump('<pre>',Yii::app()->modules['User']));
        if (!isset(Yii::app()->modules['User']['modules']['Rbam']))
            throw new CHttpException(403, 'Modulul Rbam nu este setat!');
        $this->render('getRbamIframe');
    }
}