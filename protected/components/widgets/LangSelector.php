<?php

class LangSelector extends CWidget
{
    public $htmlOptions;

    public function run()
    {
        $currentLang = Yii::app()->language;
        $languages = Yii::app()->params->language;
        $this->render('langSelector', array('currentLang' => $currentLang, 'language' => $languages, 'htmlOptions' => $this->htmlOptions));
    }
}

?>
