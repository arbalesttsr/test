<?php
Yii::import('booster.widgets.TbExtendedGridView');

class AvantGridView extends TbExtendedGridView
{
    public $title = '';
    public $tbl_classes = array();
    public $hide_btns = false;
    public $hide_per_page = false;
    public $set_buttons_width = true;
    public $panel_class = 'panel-sky';
    public $per_page_text = '';
    public $buttons_style = 'color'; // 'color|gray'

    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->loadingCssClass = '';
		$this->per_page_text = Yii::t('mess','Inregistrari pe o pagina:');
        $template = "<div class='panel $this->panel_class'>";
        /*$template .= "<div class='panel-heading'>";
            $template .= "<h4>$this->title</h4>";
        $template .= "</div>";*/
        $template .= "<div class='panel-body' style='overflow: hidden;'>";
        if (!$this->hide_per_page) {
            $template .= "<label class='col-md-4'>";
            $template .= "<span class='pull-left' style='margin-top: 10px; font-size: 15px;'>$this->per_page_text</span>";
            $template .= CHtml::dropDownList('synapsisPageSize',
                Yii::app()->user->getState('synapsisPageSize', 10),
                array(10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200, 400 => 400),
                array(
                    'onchange' => 'var pS = $(this).val(); $.get("' . Yii::app()->createUrl('site/setPageSize') . '", { pageSize: pS } ); $.fn.yiiGridView.update("user-grid",{ data:{pageSize: pS }});',
                    'class' => 'form-control pull-left',
                    'style' => 'height: 40px; width: 60px; margin-left: 10px;'
                )
            );
            $template .= "</label>";
        }
//        $template .= "{pager}\n<div style='clear: both'></div> <hr/>";
        $template .= "{items}\n";
        $template .= "<div class='col-md-4'>{summary}</div>{pager}";
        $template .= "</div>";
        $template .= "</div>";
        $this->template = $template;

        if (!$this->hide_btns)
            $this->columns = array_merge($this->columns,
                array(//$cdcol
                    array(
                        'class' => 'CButtonColumn',
                        'id' => 'table-' . md5(time()),
                        //'htmlOptions' => array('style'=>'width:95px'),
                        'deleteButtonImageUrl' => false,
                        'updateButtonImageUrl' => false,
                        'viewButtonImageUrl' => false,
                        'template' => '{view}{update}{delete}',
                        'buttons' => array(
                            'view' => array(
                                'options' => array('class' => "btn-action glyphicons eye_open btn-info", 'title' => Yii::t('mess','view')),
                                //'label' => '<i></i>',
								'label' => '',
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
            /*<div class="btn-group">
                                            <a class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a><a class="btn btn-default btn-sm"><i class="fa fa-times"></i></a>
                                        </div>*/
            foreach ($this->columns as $key_col => $column) {
                if (is_array($column) && array_key_exists('buttons', $column)) {
                    $buttons = $column['buttons'];
                    foreach ($buttons as $key => $button) {
                        if ($key === 'view') {
                            $this->columns[$key_col]['viewButtonImageUrl'] = false;
                            if ($this->buttons_style == 'color') {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "fa fa-eye", 'title' => 'view');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '';
                            } else {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn btn-default btn-sm", 'title' => 'view');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '<i class="fa fa-eye"></i>';
                            }
                        } elseif ($key === 'update') {
                            $this->columns[$key_col]['updateButtonImageUrl'] = false;
                            if ($this->buttons_style == 'color') {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "fa fa-pencil", 'title' => 'update');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '';
                            } else {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn btn-default btn-sm", 'title' => 'update');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '<i class="fa fa-pencil"></i>';
                            }
                        } elseif ($key === 'delete') {
                            $this->columns[$key_col]['deleteButtonImageUrl'] = false;
                            if ($this->buttons_style == 'color') {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "fa fa-times", 'title' => 'delete');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '';
                            } else {
                                $this->columns[$key_col]['buttons'][$key]['options'] = array('class' => "btn btn-default btn-sm", 'title' => 'delete');
                                $this->columns[$key_col]['buttons'][$key]['label'] = '<i class="fa fa-times"></i>';
                            }
                        }
                    }
                    if ($this->set_buttons_width) {
                        $coef = $this->buttons_style == 'color' ? 35 : 38;
                        $width_cols = count($column['buttons']) * $coef;
                        $this->columns[$key_col]['htmlOptions'] = array('style' => 'width:' . $width_cols . 'px', 'data-title' => 'actiuni');
                    }
                } //elseif(rand() % 3 != 0)
                //$this->columns[$key_col]['headerHtmlOptions'] = array('class'=>'info');
            }
        }
        $this->responsiveTable = true;

        $this->pager = array('class' => 'CLinkPager', 'header' => '', 'previousPageCssClass' => '', 'nextPageCssClass' => '', 'selectedPageCssClass' => 'active', 'hiddenPageCssClass' => 'disabled', 'cssFile' => '', 'htmlOptions' => array('class' => 'pagination'));

        if (empty($this->tbl_classes))
            $this->tbl_classes = array('table', 'table-striped', 'table-flipscroll_', 'table-responsive');

        $this->itemsCssClass = implode(' ', $this->tbl_classes);

        parent::init();

        if (!Yii::app()->request->isAjaxRequest)
            Yii::app()->clientScript->registerCss('control-table-items-design', "
                td a.fa {text-decoration: none!important;}
                td a.fa:before {font-size: 20px!important; margin-right: 5px!important;}
                td a.fa.fa-eye:before {color: #4f8edc!important;}
                td a.fa.fa-pencil:before {color: #85c744!important;}
                td a.fa.fa-times:before {color: #e73c3c!important;}

                div.summary {text-align: left!important; margin-top: 10px!important;}
            ");

    }

}
