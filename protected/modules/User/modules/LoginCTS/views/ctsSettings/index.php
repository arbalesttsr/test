<?php
/* @var $this CtsSettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('mess','Cts Settings'),
);

$this->menu = array(
    array('label' => Yii::t('mess','Create Cts Settings'), 'url' => array('create')),
    array('label' => Yii::t('mess','Manage Cts Settings'), 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','Cts Settings') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
