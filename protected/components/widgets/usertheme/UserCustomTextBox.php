<?php

class UserCustomTextBox extends CWidget
{
    public $addon = false;
    public $addon_glyph = false;
    public $placeholder = '';
    public $disabled = false;
    public $class = '';
    public $name = '';
    public $value = '';
    public $tooltip = '';
    public $htmlOptions = array();

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        if ($this->class)
            $this->htmlOptions['class'] = $this->class;

        if ($this->name != '') {
            $this->htmlOptions['id'] = $this->name;
            $this->htmlOptions['name'] = $this->name;
        }

        if ($this->disabled)
            $this->htmlOptions['disabled'] = 'disabled';

        if ($this->placeholder)
            $this->htmlOptions['placeholder'] = $this->placeholder;

        if ($this->tooltip) {
            $this->htmlOptions['placeholder'] = $this->placeholder;
        }

        echo $this->createInput();
    }

    private function createInput()
    {
        $ret = CHtml::textField($this->name, $this->value, $this->htmlOptions);

        if ($this->tooltip) {
            $ret = $ret .
                '<span class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="' .
                $this->tooltip .
                '"><i></i></span>';
        }

        if ($this->addon || $this->addon_glyph) {
            if ($this->addon_glyph)
                $addon = '<span class="add-on glyphicons ' . $this->addon_glyph . '"><i></i></span>';
            else
                $addon = '<span class="add-on">' . $this->addon . '</span>';

            $ret = '<div class="input-prepend">' .
                $addon .
                $ret .
                '</div>';
        }

        return $ret;
    }
}

?>
