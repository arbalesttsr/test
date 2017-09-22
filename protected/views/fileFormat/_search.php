<?php
/* @var $this FilesFormatsController */
/* @var $model FilesFormats */
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
        <?php echo $form->label($model, 'extension'); ?>
        <?php echo $form->textField($model, 'extension', ['size' => 50, 'maxlength' => 50]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'content_type'); ?>
        <?php echo $form->textField($model, 'content_type', ['size' => 60, 'maxlength' => 100]); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'icon'); ?>
        <?php echo $form->textField($model, 'icon', ['size' => 60, 'maxlength' => 100]); ?>
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
        <?php echo CHtml::submitButton(Yii::t('mess', 'search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->