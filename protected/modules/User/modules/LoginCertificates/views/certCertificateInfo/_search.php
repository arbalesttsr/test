<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */
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
        <?php echo $form->label($model, 'country_name'); ?>
        <?php echo $form->textField($model, 'country_name', array('size' => 3, 'maxlength' => 3)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'state_or_province_name'); ?>
        <?php echo $form->textField($model, 'state_or_province_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'locality_name'); ?>
        <?php echo $form->textField($model, 'locality_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'organization_name'); ?>
        <?php echo $form->textField($model, 'organization_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'organizational_unit_name'); ?>
        <?php echo $form->textField($model, 'organizational_unit_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'common_name'); ?>
        <?php echo $form->textField($model, 'common_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'email_address'); ?>
        <?php echo $form->textField($model, 'email_address', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'passphrase'); ?>
        <?php echo $form->textField($model, 'passphrase', array('size' => 60, 'maxlength' => 100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'cert_crt'); ?>
        <?php echo $form->textArea($model, 'cert_crt', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'cert_key'); ?>
        <?php echo $form->textArea($model, 'cert_key', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->