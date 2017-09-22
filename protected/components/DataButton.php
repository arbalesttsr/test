<?php
/**
 * Created by JetBrains PhpStorm.
 * User: urechean
 * Date: 20.01.14
 * Time: 10:58
 * To change this template use File | Settings | File Templates.
 */

/**
 * DataColumn class file.
 * Extends {@link CDataColumn}
 */
class DataButton extends CButtonColumn
{
    /**
     * @var boolean whether the ID in the button options should be evaluated.
     */
    public $evaluateID = false;

    /**
     * Renders the button cell content.
     * This method renders the view, update and delete buttons in the data cell.
     * Overrides the method 'renderDataCellContent()' of the class CButtonColumn
     * @param integer $row the row number (zero-based)
     * @param mixed $data the data associated with the row
     */
    public function renderDataCellContent($row, $data)
    {

        $tr = array();
        ob_start();
        foreach ($this->buttons as $id => $button) {
            if (isset($button['evaluateID']) and isset($button['options']['onclick'])) {
                if (isset($data->attributes))
                    foreach ($button['options'] as $key1 => $element1)
                        foreach ($data->attributes as $key => $element) {
                            $button['options'][$key1] = str_replace('$data->' . $key, $element, $button['options'][$key1]);
                        }
            }
            $this->renderButton($id, $button, $row, $data);
            $tr['{' . $id . '}'] = ob_get_contents();
            ob_clean();
        }
        ob_end_clean();
        echo strtr($this->template, $tr);


    }
}

?>