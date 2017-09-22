<?php

class YiiDebugController extends CController
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function getLayoutFile($layoutName)
    {
        return $this->getViewPath() . '/layouts/main.php';
    }

    public function getViewPath()
    {
        return __DIR__ . '/views';
    }


}