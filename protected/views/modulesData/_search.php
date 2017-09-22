<?php
/* @var $this ModulesDataController */
/* @var $model ModulesData */
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
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', ['size' => 60, 'maxlength' => 150]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'activ'); ?>
        <?php echo $form->textField($model, 'activ'); ?>
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
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->