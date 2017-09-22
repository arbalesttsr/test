<?php

class ModuleMenuWidget extends CWidget
{
    public $label;
    public $icon;
    public $items;

    public function run()
    {
        //die('test module');
        $this->render('modulemenu');
    }
}