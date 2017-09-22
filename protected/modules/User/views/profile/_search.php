<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'patronymic'); ?>
        <?php echo $form->textField($model, 'patronymic'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'subsidiary_id'); ?>
        <?php echo $form->textField($model, 'subsidiary_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('mess', 'search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->