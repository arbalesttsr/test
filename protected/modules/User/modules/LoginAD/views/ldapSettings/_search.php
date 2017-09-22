<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */
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
        <?php echo $form->label($model, 'ldap_host'); ?>
        <?php echo $form->textField($model, 'ldap_host', array('size' => 60, 'maxlength' => 150)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ldap_port'); ?>
        <?php echo $form->textField($model, 'ldap_port', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ldap_dc'); ?>
        <?php echo $form->textField($model, 'ldap_dc', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ldap_ou'); ?>
        <?php echo $form->textField($model, 'ldap_ou', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('mess','search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->