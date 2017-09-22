<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */
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
        <?php echo $form->label($model, 'certificates_path'); ?>
        <?php echo $form->textField($model, 'certificates_path', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'openssl_config_path'); ?>
        <?php echo $form->textField($model, 'openssl_config_path', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'digest_alg'); ?>
        <?php echo $form->textField($model, 'digest_alg', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'private_key_bits'); ?>
        <?php echo $form->textField($model, 'private_key_bits', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'private_key_type'); ?>
        <?php echo $form->textField($model, 'private_key_type', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->