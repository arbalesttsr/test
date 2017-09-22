<?php

class ThemeTopMenuListWidget extends CWidget
{
    public $label;
    public $items;

    public function run()
    {
        //$this->menuarray;
        //$currentLang = Yii::app()->language;
        //$languages = Yii::app()->params->language;
        $this->render('themetopmenulistwidget');
    }
}
                