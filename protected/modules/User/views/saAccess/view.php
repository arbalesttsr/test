<?php
/* @var $this SaAccessController */
/* @var $model SaAccess */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('mess','Sa Accesses') => array('/User/SaAccess/admin'),
    $model->id,
);

$this->menu = array(
    array('label' => Yii::t('mess', 'create') . ' ' . get_class($model), 'icon'=>'plus', 'url' => array('/User/SaAccess/create')),
    array('label' => Yii::t('mess', 'manage') . ' ' . get_class($model), 'icon'=>'list', 'url' => array('/User/SaAccess/admin')),
    array('label' => Yii::t('mess', 'update') . ' ' . get_class($model), 'icon'=>'edit', 'url' => array('/User/SaAccess/update', 'id' => $model->id)),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'ip',
    ),
)); ?>
