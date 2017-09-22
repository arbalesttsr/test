<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS' => array("User/LoginCTS/default/administration"),
    Yii::t('mess','Manage Cts Settings') => array("User/LoginCTS/ctsSettings/admin"),
    Yii::t('mess','Create Cts Settings')
);

$this->menu = array(
    //array('label'=>'List CtsSettings', 'url'=>array('index')),
    array('label' => Yii::t('mess','Manage Cts Settings'), 'icon'=>'list', 'url' => array('/User/LoginCTS/ctsSettings/admin')),
);
?>

    <h1><?= Yii::t('mess','Create Cts Settings') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>