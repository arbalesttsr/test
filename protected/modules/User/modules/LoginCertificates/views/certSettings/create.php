<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','create'),
);

$this->menu = array(
    array('label' => Yii::t('mess','MANAGE_CERTIFICATE_SETTINGS'), 'icon'=>'list', 'url' => array('admin')),
);
?>

    <h1><?= Yii::t('mess','CREATE_CERTIFICATE_SETTINGS') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>