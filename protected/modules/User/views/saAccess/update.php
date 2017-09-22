<?php
/* @var $this SaAccessController */
/* @var $model SaAccess */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('mess','Sa Accesses') => array('/User/SaAccess/admin'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('mess','update'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'create') . ' ' . get_class($model), 'icon'=>'plus', 'url' => array('/User/SaAccess/create')),
    array('label' => Yii::t('mess', 'manage') . ' ' . get_class($model), 'icon'=>'list', 'url' => array('/User/SaAccess/admin')),
    array('label' => Yii::t('mess', 'view') . ' ' . get_class($model), 'icon'=>'eye', 'url' => array('/User/SaAccess/view', 'id' => $model->id)),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>