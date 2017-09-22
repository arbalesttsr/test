<?php
/* @var $this SaAccessController */
/* @var $model SaAccess */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('mess','Sa Accesses') => array('/User/SaAccess/admin'),
    Yii::t('mess','create'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'manage') . ' ' . get_class($model), 'icon'=>'list', 'url' => array('/User/SaAccess/admin')),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>