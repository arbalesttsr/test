<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */

$this->breadcrumbs = array(
    'Cert Certificate Infos' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List CertCertificateInfo', 'url' => array('index')),
    array('label' => 'Manage CertCertificateInfo', 'url' => array('admin')),
);
?>

    <h1>Create CertCertificateInfo</h1>


    <div class="span8">
        <div class="form wide">

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'cert-certificate-info-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => false,
            )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <?php echo $form->labelEx($model, 'user_id'); ?>
                <?php
                //                echo $form->dropDownList($model,'user_id',
                //                        CHtml::listData(User::model()->findAll(), 'id', 'username'),
                //                        array('prompt'=>Yii::t('UserModule.t', 'CERTIFICATE_USER_HINT')));

                $this->widget('ext.select2.ESelect2', array(
                    'model' => $model,
                    'attribute' => 'user_id',
                    'data' => User::GetUsersList(),
                    'options' => array(
                        'placeholder' => 'Select user',
                        'allowClear' => true,
                    ),
                ));
                ?>

                <?php echo $form->error($model, 'user_id'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'countryName'); ?>
                <?php echo $form->textField($model, 'countryName', array('size' => 3, 'maxlength' => 3)); ?>
                <?php echo $form->error($model, 'countryName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'stateOrProvinceName'); ?>
                <?php echo $form->textField($model, 'stateOrProvinceName', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'stateOrProvinceName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'localityName'); ?>
                <?php echo $form->textField($model, 'localityName', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'localityName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'organizationName'); ?>
                <?php echo $form->textField($model, 'organizationName', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'organizationName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'organizationalUnitName'); ?>
                <?php echo $form->textField($model, 'organizationalUnitName', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'organizationalUnitName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'commonName'); ?>
                <?php echo $form->textField($model, 'commonName', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'commonName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'emailAddress'); ?>
                <?php echo $form->textField($model, 'emailAddress', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'emailAddress'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'passphrase'); ?>
                <?php echo $form->textField($model, 'passphrase', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'passphrase'); ?>
            </div>

            <!--	<div class="row">
		<?php echo $form->labelEx($model, 'cert_crt'); ?>
		<?php echo $form->textArea($model, 'cert_crt', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'cert_crt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'cert_key'); ?>
		<?php echo $form->textArea($model, 'cert_key', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'cert_key'); ?>
	</div>-->

            <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>