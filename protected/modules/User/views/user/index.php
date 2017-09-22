<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

/* $this->breadcrumbs=array(
	'Users',
); */

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'url' => array('register')),
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'url' => array('admin')),
);
?>
<div class="page-header">
    <h1><?php Yii::t('UserModule.t', 'USERS') ?></h1>
</div>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
