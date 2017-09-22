<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $this->module->id => array("/{$this->module->id}/default/administration"),
    Yii::t('UserModule.t', 'USERS') => array('/User/user/admin'),
    Yii::t('UserModule.t', 'REGISTER_USER'),
);

$this->menu = array(
//	array('label'=>'List User', 'url'=>array('index')),
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon'=>'list', 'url' => array('admin')),
);
?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'REGISTER_USER'); ?></h1>
</div>

<div class="container">
    <!--div class="span6"-->
    <div class="form wide">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )); ?>

        <?php echo Yii::t('mess', 'FIELDS_ARE_REQUIRED') ?>

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
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('size' => 45, 'maxlength' => 128, 'placeholder' => Yii::t('UserModule.t', 'PASSWORD'))); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'passwordCompare'); ?>
            <?php echo $form->passwordField($model, 'passwordCompare', array('size' => 45, 'maxlength' => 128, 'placeholder' => Yii::t('UserModule.t', 'REPEAT_PASSWORD'))); ?>
            <?php echo $form->error($model, 'passwordCompare'); ?>
        </div>
        <?php
        if (User::checkClientLogin()) {
            ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'sql_user'); ?>
                <?php echo $form->checkBox($model, 'sql_user'); ?>
                <?php echo $form->error($model, 'sql_user'); ?>
            </div>
            <?php
        }
        ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('UserModule.t', 'REGISTER')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
    <!--/div-->
</div>