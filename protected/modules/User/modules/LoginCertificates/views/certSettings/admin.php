<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','manage'),
);

$this->menu = array(
    array('label' => Yii::t('mess','List CertSettings'), 'icon'=>'list', 'url' => array('index')),
    array('label' => Yii::t('mess','CREATE_CERTIFICATE_SETTINGS'), 'icon'=>'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cert-settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess','MANAGE_CERTIFICATE_SETTINGS') ?></h1>


<?php echo CHtml::link(Yii::t('mess','adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'cert-settings-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'certificates_path',
        'key_path',
        'openssl_config_path',
        'digest_alg',
        'private_key_bits',
        'private_key_type',
        'default_id' => array(
            //'header' => 'Sql User',
            'name' => 'default_id',
            'value' => '($data->default_id !==0)? "Active" : "Disable"',
            'filter' => array(0 => 'Disable', 1 => 'Active'),
            // 'htmlOptions' => array('style' => "text-align:center;"),
        ),
//		array(
//			'class'=>'CButtonColumn',
//		),
    ),
)); ?>
