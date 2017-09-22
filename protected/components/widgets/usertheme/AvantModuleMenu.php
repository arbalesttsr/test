<?php

class AvantModuleMenu extends CWidget
{
    public $label;
    public $icon;
    public $items = array();
    public $module;

    public function run()
    {
        $module = Yii::app()->controller->module->id;
        $this->label = 'Actiuni Model ' . $module;

        $modules = Yii::app()->modules;
        if (isset($modules[$module]) && isset($modules[$module]["front_tiles"]) && isset($modules[$module]["front_tiles"]["icon"]))
            $this->label = '<span style="margin-right: 5px;"><i class="fa fa-' . $modules[$module]["front_tiles"]["icon"] . '"></i></span>' . $this->label;
        //die('test module');
        $this->render('avantModuleMenu');
    }
}