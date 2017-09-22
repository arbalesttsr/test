<?php
/* @var $this LdapSettingsController */
/* @var $model Holidays */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'holidays-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?= Yii::t('mess','The fields with') ?><span class="required">*</span> <?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'holiday_date'); ?>
        <?php echo $form->dateField($model, 'holiday_date'); ?>
        <?php echo $form->error($model, 'holiday_date'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
