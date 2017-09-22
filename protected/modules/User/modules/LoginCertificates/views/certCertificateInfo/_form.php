<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cert-certificate-info-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"> <?= Yii::t('mess','The fields with') ?> <span class="required">*</span> <?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php
        // echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20));
        ?>

        <?php
        //                echo $form->dropDownList($model,'user_id',
        //                        CHtml::listData(User::model()->findAll(), 'id', 'username'),
        //                        array('prompt'=>Yii::t('UserModule.t', 'CERTIFICATE_USER_HINT')));

        $this->widget('ext.select2.ESelect2', array(
            'model' => $model,
            'attribute' => 'user_id',
            'data' => User::GetUsersList(),
            'options' => array(
                'placeholder' => Yii::t('mess','Select user'),
                'allowClear' => true,
            ),
        ));
        ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'country_name'); ?>
        <?php echo $form->textField($model, 'country_name', array('size' => 3, 'maxlength' => 3, 'placeholder' => 'MD')); ?>
        <?php echo $form->error($model, 'country_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'state_or_province_name'); ?>
        <?php echo $form->textField($model, 'state_or_province_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Moldova')); ?>

        <?php echo $form->error($model, 'state_or_province_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'locality_name'); ?>
        <?php echo $form->textField($model, 'locality_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Chisinau')); ?>
        <?php echo $form->error($model, 'locality_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'organization_name'); ?>
        <?php echo $form->textField($model, 'organization_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'Company')); ?>
        <?php echo $form->error($model, 'organization_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'organizational_unit_name'); ?>
        <?php echo $form->textField($model, 'organizational_unit_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => 'OU')); ?>
        <?php echo $form->error($model, 'organizational_unit_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'common_name'); ?>
        <?php echo $form->textField($model, 'common_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => '')); ?>
        <?php echo $form->error($model, 'common_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email_address'); ?>
        <?php echo $form->textField($model, 'email_address', array('size' => 255, 'maxlength' => 255, 'placeholder' => 'email@email.com')); ?>
        <?php echo $form->error($model, 'email_address'); ?>
    </div>
    <!--
	<div class="row">
		<?php echo $form->labelEx($model, 'passphrase'); ?>
		<?php echo $form->textField($model, 'passphrase', array('size' => 60, 'maxlength' => 100, 'placeholder' => 'phrase')); ?>
		<?php echo $form->error($model, 'passphrase'); ?>
	</div>-->
    <div class="row">
        <?php echo $form->labelEx($model, 'passphrase'); ?>
        <?php echo $form->passwordField($model, 'passphrase'); ?>
        <?php echo $form->error($model, 'passphrase'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'passphraseCompare'); ?>
        <?php echo $form->passwordField($model, 'passphraseCompare'); ?>
        <?php echo $form->error($model, 'passphraseCompare'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cert_crt'); ?>
        <?php echo $form->textArea($model, 'cert_crt', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'cert_crt'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'cert_key'); ?>
        <?php echo $form->textArea($model, 'cert_key', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'cert_key'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->