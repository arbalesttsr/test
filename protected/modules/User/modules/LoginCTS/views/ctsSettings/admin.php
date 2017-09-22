<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS' => array("User/LoginCTS/default/administration"),
    Yii::t('mess','Manage Cts Settings'),
);

$this->menu = array(
    //array('label'=>'List CtsSettings', 'url'=>array('index')),
    array('label' => Yii::t('mess','Create Cts Settings'), 'icon'=>'plus', 'url' => array('/User/LoginCTS/ctsSettings/create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cts-settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess','Manage Cts Settings') ?></h1>


<?php echo CHtml::link(Yii::t('mess','adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'cts-settings-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        //'key',
        //'certificate',
        //'validate_response_key',
        'callback_url',
        'login_url',
        'logout_url',
        //'asserationNS',
        //'prefix',
        'issuer',
        //'key_path',
        //'certificate_path',
        //'v_responsekey_path',
        'is_default' => array(
            // 'header' => 'Status',
            'name' => 'is_default',

            'value' => '($data->is_default == 0) ? "Inactive" : "Active"',
            'filter' => array('0' => 'Inactive', '1' => 'Active'),
            'htmlOptions' => array('style' => "text-align:center;"),
        ),
//		array(
//			'class'=>'CButtonColumn',
//		),
    ),
)); ?>
