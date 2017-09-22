<?php
/* @var $this UserSettingsController */
/* @var $model UserSettings */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id', array('size' => 20, 'maxlength' => 20)); ?>
    </div>


    <div class="row">
        <?php echo $form->label($model, 'time_limit'); ?>
        <?php echo $form->textField($model, 'time_limit', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'restricted_id'); ?>
        <?php echo $form->textField($model, 'restricted_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'restricted_days'); ?>
        <?php echo $form->textField($model, 'restricted_days', array('size' => 50, 'maxlength' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'restricted_date'); ?>
        <?php echo $form->textField($model, 'restricted_date', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'restricted_interval'); ?>
        <?php echo $form->textField($model, 'restricted_interval', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date_start'); ?>
        <?php echo $form->textField($model, 'date_start'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->