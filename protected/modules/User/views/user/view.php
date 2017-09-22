<?php
/* @var $this UserController */
/* @var $model User */

/* $this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
); */

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'url' => array('register')),
    array('label' => Yii::t('UserModule.t', 'UPDATE_USER'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'url' => array('admin')),
    array('label' => Yii::t('UserModule.t', 'EDIT_PROFILE'), 'url' => array('edit', 'id' => $model->id)),
    array('label' => Yii::t('UserModule.t', 'CHANGE_PASSWORD'), 'url' => array('password/change')),
);
?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'USER') ?> #<?php echo $model->id; ?></h1>
</div>

<div class="span6">
    <div class="page-header">
        <h5><?php echo Yii::t('UserModule.t', 'BASE_INFO') ?></h5>
    </div>
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'id',
            'username',
            //'password_hash',
            'idnp',
            'ad_username',
        ),
    )); ?>
</div>

<div class="span6">
    <div class="page-header">
        <h5><?php echo Yii::t('UserModule.t', 'ADD_INFO') ?></h5>
    </div>
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'create_user_id',
            'create_datetime',
            'update_user_id',
            'update_datetime',
        ),
    )); ?>
</div>