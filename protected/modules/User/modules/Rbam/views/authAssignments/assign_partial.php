<?php
/* SVN FILE: $Id: assign.php 9 2010-12-17 13:21:39Z Chris $*/
/**
 * Create Auth Assignments view.
 *
 * @copyright    Copyright &copy; 2010 PBM Web Development - All Rights Reserved
 * @package        RBAM
 * @since            V1.0.0
 * @version        $Revision: 9 $
 * @license        BSD License (see documentation)
 */


$this->widget('User.modules.Rbam.extensions.alphapager.ApGridView', array(
    'id' => 'roles',
    'dataProvider' => $dataProvider,
    'template' => "{summary}\n{alphapager}\n{pager}\n{items}",
    'summaryText' => Yii::t('RbamModule.rbam', '{start}-{end} of <span>{count}</span> {items}', array('{items}' => Yii::t('RbamModule.rbam', 'roles'))),
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'header' => Yii::t('RbamModule.rbam', 'Name'),
            'headerHtmlOptions' => array('scope' => 'col'),
            'htmlOptions' => array('class' => 'item-name'),
        ),
        array(
            'name' => 'description',
            'type' => 'ntext',
            'header' => Yii::t('RbamModule.rbam', 'Description'),
            'headerHtmlOptions' => array('scope' => 'col'),
        ),
        array(
            'name' => 'bizrule',
            'type' => 'raw',
            'header' => Yii::t('RbamModule.rbam', 'Business Rule'),
            'headerHtmlOptions' => array('scope' => 'col'),
        ),
        array(
            'name' => 'data',
            'type' => 'raw',
            'header' => Yii::t('RbamModule.rbam', 'Data'),
            'headerHtmlOptions' => array('scope' => 'col'),
        ),
        array(
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->parentCount',
            'urlExpression' => '$this->grid->getOwner()->createUrl("authItems/getParents",array("item"=>$data->name))',
            'linkHtmlOptions' => array('onclick' => 'return false;'),
            'header' => Yii::t('RbamModule.rbam', 'Parents'),
            'headerHtmlOptions' => array('scope' => 'col'),
            'htmlOptions' => array('class' => 'parents number', 'title' => Yii::t('RbamModule.rbam', 'Click to toggle parent items'))
        ),
        array(
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->childCount',
            'urlExpression' => '$this->grid->getOwner()->createUrl("authItems/getChildren",array("item"=>$data->name))',
            'linkHtmlOptions' => array('onclick' => 'return false;'),
            'header' => Yii::t('RbamModule.rbam', 'Children'),
            'headerHtmlOptions' => array('scope' => 'col'),
            'htmlOptions' => array('class' => 'children number', 'title' => Yii::t('RbamModule.rbam', 'Click to toggle child items'))
        ),
        array(
            'class' => 'CCheckBoxColumn',
            'header' => Yii::t('RbamModule.rbam', 'Assign'),
            'headerHtmlOptions' => array('scope' => 'col'),
            'value' => '$data->name'
        )
    )
));

