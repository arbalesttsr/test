<?php
/* @var $this ProfileController */
/* @var $dataProvider CActiveDataProvider */

/* $this->breadcrumbs=array(
	'Profiles',
); */

$this->menu = array(
    //array('label'=>Yii::t('UserModule.user','Create Profile'), 'url'=>array('create')),
    array('label' => Yii::t('UserModule.t', 'MANAGE_PROFILES'), 'url' => array('admin')),
);
?>

<h1><?php Yii::t('UserModule.t', 'PROFILES') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
