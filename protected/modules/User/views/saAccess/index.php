<?php
/* @var $this SaAccessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('mess','Sa Accesses'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'list') . ' ' . get_class($dataProvider->model), 'url' => array('index')),
    array('label' => Yii::t('mess', 'create') . ' ' . get_class($dataProvider->model), 'url' => array('create')),
    array('label' => Yii::t('mess', 'manage') . ' ' . get_class($dataProvider->model), 'url' => array('admin')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
