<?php
/* @var $this BusinessCategoryController */
/* @var $model BusinessCategory */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ]); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', ['size' => 60, 'maxlength' => 150]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', ['rows' => 6, 'cols' => 50]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_user_id'); ?>
        <?php echo $form->textField($model, 'create_user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_datetime'); ?>
        <?php echo $form->textField($model, 'create_datetime'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_user_id'); ?>
        <?php echo $form->textField($model, 'update_user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_datetime'); ?>
        <?php echo $form->textField($model, 'update_datetime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->