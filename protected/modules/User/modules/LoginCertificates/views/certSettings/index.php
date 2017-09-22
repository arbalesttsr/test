<?php
/* @var $this CertSettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','Cert Settings'),
);

$this->menu = array(
    array('label' => Yii::t('mess','CREATE_CERTIFICATE_SETTINGS'), 'url' => array('create')),
    array('label' => Yii::t('mess','MANAGE_CERTIFICATE_SETTINGS'), 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','Cert Settings') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
