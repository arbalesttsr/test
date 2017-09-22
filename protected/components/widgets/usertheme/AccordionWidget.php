<?php

class AccordionWidget extends CWidget
{
    public $data;

    public function run()
    {
        //echo $this->menuarray;
        //$currentLang = Yii::app()->language;
        //$languages = Yii::app()->params->language;
        $this->render('accordion', array('data' => $this->data));
    }
}

?>

