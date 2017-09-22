<?php

class ThemeTopMenuItemWidget extends CWidget
{
    public $options = array();

    public function run()
    {
        //$label = $this->options['label'];
        //$url = $this->options['url'];
        $this->render('themetopmenuitemwidget', array('options' => $this->options));
    }
}
                