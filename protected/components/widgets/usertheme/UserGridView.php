<?php
Yii::import('zii.widgets.grid.CGridView');

class UserGridView extends CGridView
{
    public $tbl_classes = array();
    public $hide_btns = false;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->loadingCssClass = '';
        if (!$this->hide_btns)
            $this->columns = array_merge($this->columns,
                array(//$cdcol
                    array(
                        'class' => 'CButtonColumn',
                        'id' => 'fghj',
                        'htmlOptions' => array('style' => 'width:95px'),
                        'deleteButtonImageUrl' => false,
                        'updateButtonImageUrl' => false,
                        'viewButtonImageUrl' => false,
                        'template' => '{view}{update}{delete}',
                        'buttons' => array(
                            'view' => array(
                                'options' => array('class' => "btn-action glyphicons eye_open btn-info", 'title' => 'Vizualizare'),
                                'label' => '<i></i>',
                            ),
                            'update' => array(
                                'options' => array('class' => "btn-action glyphicons pencil btn-success", 'title' => 'Actualizare'),
                                'label' => '<i></i>',
                            ),
                            'delete' => array(
                                'options' => array('class' => "btn-action glyphicons remove_2 btn-danger", 'title' => 'Ştergere'),
                                'label' => '<i></i>',
                            ),
                        )
                    )
                )
            );

        if (isset($this->columns)) {

            foreach ($this->columns as $key_col => $column) {
                if (is_array($column) && array_key_exists('buttons', $column)) {
                    $buttons = $column['buttons'];
                    foreach ($buttons as $key => $button) {
                        if ($key === 'view') {
                            $this->columns[$key_col]['viewButtonImageUrl'] = false;
                            $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn-action glyphicons eye_open btn-info", 'title' => 'view');
                            $this->columns[$key_col]['buttons'][$key]['label'] = '<i></i>';
                        } elseif ($key === 'update') {
                            $this->columns[$key_col]['updateButtonImageUrl'] = false;
                            $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn-action glyphicons pencil btn-success", 'title' => 'update');
                            $this->columns[$key_col]['buttons'][$key]['label'] = '<i></i>';
                        } elseif ($key === 'delete') {
                            $this->columns[$key_col]['deleteButtonImageUrl'] = false;
                            $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn-action glyphicons remove_2 btn-danger", 'title' => 'delete');
                            $this->columns[$key_col]['buttons'][$key]['label'] = '<i></i>';
                        }
                    }
                    $width_cols = count($column['buttons']) * 35;
                    $this->columns[$key_col]['htmlOptions'] = array('style' => 'width:' . $width_cols . 'px');
                }
            }
        }

        $this->pager = array('class' => 'CLinkPager', 'header' => '', 'previousPageCssClass' => '', 'selectedPageCssClass' => 'active', 'hiddenPageCssClass' => 'disabled', 'cssFile' => '');
        parent::init();

        Yii::app()->getClientScript()->scriptMap = array('jquery.js' => false);
        Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;

        //$cdcol = new CDataColumn();
        if (empty($this->tbl_classes))
            $this->tbl_classes = array('table', 'table-primary', 'table-vertical-center', 'table-thead-simple');

        $this->itemsCssClass = implode(' ', $this->tbl_classes);

        //Yii::app()->clientScript->registerScript('pagination-classes', "$('.pager').addClass('pagination pagination-right pagination-small');");

    }

}
