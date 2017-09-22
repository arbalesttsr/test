<?php
/* @var $this StorageController */
/* @var $model Storage */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ]); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id', ['size' => 20, 'maxlength' => 20]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', ['size' => 60, 'maxlength' => 100]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'action'); ?>
        <?php echo $form->textField($model, 'action', ['size' => 60, 'maxlength' => 100]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_user_id'); ?>
        <?php echo $form->textField($model, 'create_user_id', ['size' => 20, 'maxlength' => 20]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'create_datetime'); ?>
        <?php echo $form->textField($model, 'create_datetime'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_user_id'); ?>
        <?php echo $form->textField($model, 'update_user_id', ['size' => 20, 'maxlength' => 20]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'update_datetime'); ?>
        <?php echo $form->textField($model, 'update_datetime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton("Cautare"); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->