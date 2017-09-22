<?php

class AvantViewMenu extends CWidget
{
    public $label;
    public $icon;
    public $items;

    public function run()
    {
        $module = '';
        if(isset($_GET['modelName']))
            $module = $_GET['modelName'];
        if(isset(Yii::app()->controller->module->id))
            $module = Yii::app()->controller->module->id . '/' . $module;

        $this->label = 'Actiuni asupra modelului ' . $module;

        $modules = Yii::app()->modules;
        if (isset($modules[$module]) && isset($modules[$module]["front_tiles"]) && isset($modules[$module]["front_tiles"]["icon"]))
            $this->label = '<span style="margin-right: 5px;"><i class="fa fa-' . $modules[$module]["front_tiles"]["icon"] . '"></i></span>' . $this->label;
        //die('test module');
        $this->render('avantModuleMenu');
        //die('test module');
        $this->render('avantViewMenu');
    }
}