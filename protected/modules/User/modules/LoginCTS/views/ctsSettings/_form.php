<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cts-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));

    //echo CtsSettings::getCtsSettingDefault()->key_path;
    ?>

    <p class="note"><?= Yii::t('mess','The fields with') ?> <span class="required">*</span> <?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_default'); ?>
        <?php echo $form->checkBox($model, 'is_default'); ?>
        <?php echo $form->error($model, 'is_default'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'key'); ?>
        <?php echo $form->fileField($model, 'key'); ?>
        <?php echo $form->error($model, 'key'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'certificate'); ?>
        <?php echo $form->fileField($model, 'certificate'); ?>
        <?php echo $form->error($model, 'certificate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'validate_response_key'); ?>
        <?php echo $form->fileField($model, 'validate_response_key'); ?>
        <?php echo $form->error($model, 'validate_response_key'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'callback_url'); ?>
        <?php echo $form->textField($model, 'callback_url', array('size' => 60, 'maxlength' => 255, 'placeholder' => '/User/site/login')); ?>
        <?php echo $form->error($model, 'callback_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'login_url'); ?>
        <?php echo $form->dropDownList($model, 'login_url', $model->GetSiteDefaultMpass(), array('options' => array('https://testmpass.gov.md/login/saml' => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'login_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'logout_url'); ?>
        <?php echo $form->dropDownList($model, 'logout_url', $model->GetSiteDefaultMpass(), array('options' => array('https://testmpass.gov.md/logout/saml' => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'logout_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'asserationNS'); ?>
        <?php echo $form->textField($model, 'asserationNS', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'asserationNS'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'prefix'); ?>
        <?php echo $form->textField($model, 'prefix', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'prefix'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'issuer'); ?>
        <?php echo $form->textField($model, 'issuer', array('size' => 60, 'maxlength' => 255, 'placeholder' => Yii::t('mess','Url site emitent ex'). 'http://ghiseu.justice.gov.md/')); ?>
        <?php echo $form->error($model, 'issuer'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->