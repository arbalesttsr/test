<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','manage'),
);

$this->menu = array(
    array('label' => Yii::t('mess','Create CertificateInfo'), 'icon'=>'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cert-certificate-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess','Manage CertificateInfo') ?></h1>


<?php echo CHtml::link(Yii::t('mess','adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'cert-certificate-info-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'user_id' => array(
            'name' => 'user_id',
            'value' => '$data->user->username',
        ),
        'country_name',
        'state_or_province_name',
        'locality_name',
        'organization_name',
        'organizational_unit_name',
        'common_name',
        'email_address',
        /*
        'organizationalUnitName',
        'commonName',
        'emailAddress',
        'passphrase',
        'cert_crt',
        'cert_key',
        */
//		array(
//			'class'=>'CButtonColumn',
//		),
    ),
)); ?>
