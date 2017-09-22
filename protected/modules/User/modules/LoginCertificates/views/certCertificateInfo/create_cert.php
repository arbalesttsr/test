<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','create'),
);

$this->menu = array(
    array('label' => Yii::t('mess','Manage CertificateInfo'), 'icon'=>'list', 'url' => array('admin')),
);
?>

    <h1><?= Yii::t('mess','Create CertificateInfo') ?></h1>

<?php
//die(var_dump($model));
$this->renderPartial('_form', array('model' => $model)); ?>