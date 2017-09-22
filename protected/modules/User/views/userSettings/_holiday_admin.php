<?php
/* @var $this UserSettingsController */
/* @var $model Holidays */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('mess','Holidays') => array('User/userSettings/holidaysAdmin'),
    Yii::t('mess','manage'),
);

$this->menu = array(
    //array('label'=>'List UserSettings', 'url'=>array('index')),
    array('label' => Yii::t('mess','Create Holidays'), 'icon'=>'plus', 'url' => array('createHolidays')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess','Manage User Holidays') ?></h1>
<br>


<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'user-settings-grid',
    'hide_btns' => true,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'holiday_date',
        'description',
        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{updateHoliday}{deleteHoliday}',
            'buttons' => array(
                'updateHoliday' => array(
                    'url' => 'Yii::app()->createUrl("User/UserSettings/updateHolidays", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-edit", 'title' => Yii::t('mess', 'update')),
					'label' => '',
                ),

                'deleteHoliday' => array(
                    'url' => 'Yii::app()->createUrl("User/UserSettings/deleteHolidays", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-remove",'title' => Yii::t('mess', 'delete')),
					'label' => '',
                ),
            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
