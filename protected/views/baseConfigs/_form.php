<?php
/* @var $this BaseConfigsController */
/* @var $model BaseConfigs */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'base-configs-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ]); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'config_label'); ?>
        <?php echo $form->textField($model, 'config_label', ['size' => 60, 'maxlength' => 200]); ?>
        <?php echo $form->error($model, 'config_label'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'config_value'); ?>
        <?php echo $form->textField($model, 'config_value', ['size' => 60, 'maxlength' => 300]); ?>
        <?php echo $form->error($model, 'config_value'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->