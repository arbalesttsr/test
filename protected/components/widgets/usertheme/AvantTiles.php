<?php

class AvantTiles extends CWidget
{
    public $type = 'info';
    public $color = 'indigo';
    public $icon = 'square';
    public $heading = '';
    public $footer = '';
    public $text = '';
    public $href = '#';

    public function run()
    {
        $this->render('avantTiles');
    }
}

?>