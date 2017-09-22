<?php
/* @var $this CertificateController */
/* @var $model CertificateForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Certificate';
$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'USERS'), 'url' => array('/User/user/index')),
    //array('label' => Yii::t('UserModule.t','CERTIFICATES'), 'url'=>array('/User/certificate/create')),
    array('label' => Yii::t('UserModule.t', 'SETTINGS'), 'url' => array('/User/LoginCertificates/certSettings/admin')),
    array('label' => Yii::t('UserModule.t', 'CERTIFICATES'), 'url' => array('/User/LoginCertificates/certCertificateInfo/admin')),
);
?>

<h3><?php echo Yii::t('UserModule.t', 'CERTIFICATES') ?></h3>

<div class="span8">
    <div class="form wide">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'private-key-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <?php echo Yii::t('base', 'FIELDS_ARE_REQUIRED') ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'user_id'); ?>
            <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(
                User::model()->findAll(), 'id', 'username'), array('prompt' => Yii::t('UserModule.t', 'CERTIFICATE_USER_HINT'))); ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>

        <fieldset>
            <h4><?php echo Yii::t('UserModule.t', 'CERTIFICATE_INFO') ?></h4>
            <div class="row">
                <?php echo $form->labelEx($model, 'countryName'); ?>
                <?php echo $form->textField($model, 'countryName'); ?>
                <?php echo $form->error($model, 'countryName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'stateOrProvinceName'); ?>
                <?php echo $form->textField($model, 'stateOrProvinceName'); ?>
                <?php echo $form->error($model, 'stateOrProvinceName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'localityName'); ?>
                <?php echo $form->textField($model, 'localityName'); ?>
                <?php echo $form->error($model, 'localityName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'organizationName'); ?>
                <?php echo $form->textField($model, 'organizationName'); ?>
                <?php echo $form->error($model, 'organizationName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'organizationalUnitName'); ?>
                <?php echo $form->textField($model, 'organizationalUnitName'); ?>
                <?php echo $form->error($model, 'organizationalUnitName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'commonName'); ?>
                <?php echo $form->textField($model, 'commonName'); ?>
                <?php echo $form->error($model, 'commonName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'emailAddress'); ?>
                <?php echo $form->textField($model, 'emailAddress'); ?>
                <?php echo $form->error($model, 'emailAddress'); ?>
            </div>
        </fieldset>

        <fieldset>
            <h4><?php echo Yii::t('UserModule.t', 'CERTFICATE_PASSPHRASE') ?></h4>
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
        </fieldset>
        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('label', 'CREATE')); ?>
            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="flash-success">
                    <?php echo Yii::app()->user->getFlash('success') ?>
                </div>
            <?php endif; ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>