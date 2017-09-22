<?php
/* @var $this UserSettingsController */
/* @var $model UserSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'time_limit'); ?>
        <?php echo $form->textField($model, 'time_limit', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'time_limit'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'restricted_id'); ?>
        <?php echo $form->textField($model, 'restricted_id'); ?>
        <?php echo $form->error($model, 'restricted_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'restricted_days'); ?>
        <?php echo $form->textField($model, 'restricted_days', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'restricted_days'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'restricted_date'); ?>
        <?php echo $form->textField($model, 'restricted_date', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'restricted_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'restricted_interval'); ?>
        <?php echo $form->textField($model, 'restricted_interval', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'restricted_interval'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_start'); ?>
        <?php echo $form->textField($model, 'date_start'); ?>
        <?php echo $form->error($model, 'date_start'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'holiday_enable'); ?>
        <?php echo $form->checkBox($model, 'holiday_enable'); ?>
        <?php echo $form->error($model, 'holiday_enable'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->