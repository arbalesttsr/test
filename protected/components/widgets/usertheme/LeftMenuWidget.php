<?php

class LeftMenuWidget extends CWidget
{
    public $menuarray;

    public function run()
    {
        //echo $this->menuarray;
        //$currentLang = Yii::app()->language;
        //$languages = Yii::app()->params->language;
        $this->render('leftmenu', array('menuarray' => $this->menuarray));
    }
}

?>
                