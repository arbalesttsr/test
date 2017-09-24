<?php

class AvantLanguageWidget extends CWidget
{
    public $currentLang;
    public $languages;

    public function run()
    {
        $this->currentLang = Yii::app()->language;
        $this->languages = Yii::app()->params->language;
        $this->render('avantLanguageWidget');
    }
}

?>