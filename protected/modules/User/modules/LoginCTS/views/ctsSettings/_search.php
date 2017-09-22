<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */
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
        <?php echo $form->label($model, 'key'); ?>
        <?php echo $form->textArea($model, 'key', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'certificate'); ?>
        <?php echo $form->textArea($model, 'certificate', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'validate_response_key'); ?>
        <?php echo $form->textArea($model, 'validate_response_key', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'callback_url'); ?>
        <?php echo $form->textField($model, 'callback_url', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'login_url'); ?>
        <?php echo $form->textField($model, 'login_url', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'asserationNS'); ?>
        <?php echo $form->textField($model, 'asserationNS', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'prefix'); ?>
        <?php echo $form->textField($model, 'prefix', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('mess','search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->