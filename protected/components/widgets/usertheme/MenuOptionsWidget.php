<?php

class MenuOptionsWidget extends CWidget
{
    public $items;

    public function run()
    {
        if (isset(Yii::app()->modules['User'])) {
            $this->render('menuoptions');
        }
    }
}