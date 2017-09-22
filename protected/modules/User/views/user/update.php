<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $model->id => array('view', 'id' => $model->id),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    'Update',
);

$this->menu = array(
//	array('label'=>'List User', 'url'=>array('index')),
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'url' => array('register')),
    array('label' => Yii::t('UserModule.t', 'VIEW_USER'), 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'url' => array('admin')),
);
?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'UPDATE_USER') ?> #<?php echo $model->id; ?></h1>
</div>
<!--div class="span8"-->
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <?php echo Yii::t('base', 'FIELDS_ARE_REQUIRED') ?>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'role'); ?>
        <?php echo $form->dropDownList($model, 'role', $roles, array('placeholder' => Yii::t('UserModule.t', 'Role'), 'empty' => '---')); ?>
        <?php echo $form->error($model, 'role'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 45, 'maxlength' => 45, 'placeholder' => Yii::t('UserModule.t', 'USERNAME'))); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ad_username'); ?>
        <?php echo $form->textField($model, 'ad_username', array('size' => 45, 'maxlength' => 45, 'placeholder' => Yii::t('UserModule.t', 'AD_USERNAME'))); ?>
        <?php echo $form->error($model, 'ad_username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idnp'); ?>
        <?php echo $form->textField($model, 'idnp', array('size' => 45, 'maxlength' => 13, 'placeholder' => Yii::t('UserModule.t', 'IDNP'))); ?>
        <?php echo $form->error($model, 'idnp'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('label', 'SAVE')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<!--/div-->