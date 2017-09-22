<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cert-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?= Yii::t('mess','The fields with') ?> <span class="required">*</span> <?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'certificates_path'); ?>
        <?php echo $form->textField($model, 'certificates_path', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'certificates_path'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'key_path'); ?>
        <?php echo $form->textField($model, 'key_path', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'key_path'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'openssl_config_path'); ?>
        <?php echo $form->textField($model, 'openssl_config_path', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'openssl_config_path'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'digest_alg'); ?>
        <?php echo $form->dropDownList($model, 'digest_alg', $model->ListDigestAlg(), array('options' => array('SHA512' => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'digest_alg'); ?>
    </div>
    <!--	<div class="row">
		<?php echo $form->labelEx($model, 'digest_alg'); ?>
		<?php echo $form->textField($model, 'digest_alg', array('size' => 60, 'maxlength' => 100)); ?>
		<?php echo $form->error($model, 'digest_alg'); ?>
	</div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'private_key_bits'); ?>
        <?php echo $form->dropDownList($model, 'private_key_bits', $model->ListPrivateKeyBits(), array('options' => array('2048' => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'private_key_bits'); ?>
    </div>


    <!--	<div class="row">
		<?php echo $form->labelEx($model, 'private_key_bits'); ?>
		<?php echo $form->textField($model, 'private_key_bits', array('size' => 20, 'maxlength' => 20)); ?>
		<?php echo $form->error($model, 'private_key_bits'); ?>
	</div>-->

    <!--        <div class="row">
		<?php echo $form->labelEx($model, 'private_key_type'); ?>
		<?php echo $form->textField($model, 'private_key_type', array('size' => 60, 'maxlength' => 100)); ?>
		<?php echo $form->error($model, 'private_key_type'); ?>
	</div>-->

    <div class="row">
        <?php echo $form->labelEx($model, 'private_key_type'); ?>
        <?php echo $form->dropDownList($model, 'private_key_type', $model->ListPrivateKeyType(), array('options' => array('0' => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'private_key_type'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'default_id'); ?>
        <?php echo $form->checkBox($model, 'default_id'); ?>
        <?php echo $form->error($model, 'default_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->