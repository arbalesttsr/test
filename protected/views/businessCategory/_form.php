<?php
/* @var $this BusinessCategoryController */
/* @var $model BusinessCategory */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'business-category-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ]); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', ['size' => 60, 'maxlength' => 150]); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', ['rows' => 6, 'cols' => 50]); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'create_user_id'); ?>
        <?php echo $form->textField($model, 'create_user_id'); ?>
        <?php echo $form->error($model, 'create_user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'create_datetime'); ?>
        <?php echo $form->textField($model, 'create_datetime'); ?>
        <?php echo $form->error($model, 'create_datetime'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'update_user_id'); ?>
        <?php echo $form->textField($model, 'update_user_id'); ?>
        <?php echo $form->error($model, 'update_user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'update_datetime'); ?>
        <?php echo $form->textField($model, 'update_datetime'); ?>
        <?php echo $form->error($model, 'update_datetime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->