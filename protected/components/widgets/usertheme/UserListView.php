<?php

Yii::import('zii.widgets.CListView');

/**
 * Bootstrap Zii list view.
 */
class UserListView extends CListView
{
    /**
     * @var string the CSS class name for the pager container. Defaults to 'pagination'.
     */
    public $pagerCssClass = 'pagination';
    /**
     * @var string the URL of the CSS file used by this detail view.
     * Defaults to false, meaning that no CSS will be included.
     */
    public $cssFile = false;
    /**
     * @var string the template to be used to control the layout of various sections in the view.
     */
    //public $template = "{items}\n<div class=\"row-fluid\"><div class=\"span6\">{pager}</div><div class=\"span6\">{summary}</div></div>";

    /**
     * Initializes the widget.
     */
    public function init()
    {

        $this->pager = array('class' => 'CLinkPager', 'header' => '', 'selectedPageCssClass' => 'active', 'hiddenPageCssClass' => 'disabled');
        //die(var_dump('<pre>',$this,'</pre>'));
        parent::init();
        Yii::app()->clientScript->registerScript('listviewscript', "$('.span-19').removeClass('span-19'); $('div.items div.view').addClass('well'); $('.pager').removeClass('pager').addClass('pagination pagination-right pagination-small');");

    }

    /**
     * Renders the empty message when there is no data.
     */
    public function renderEmptyText()
    {
        $emptyText = $this->emptyText === null ? Yii::t('zii', 'No results found.') : $this->emptyText;
        echo CHtml::tag('div', array('class' => 'empty', 'span' => 12), $emptyText);
    }
}
