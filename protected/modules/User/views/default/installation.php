<?php
/* @var $this DefaultController */
/* @var $model InstallForm */
/* @var $form ------- */

?>


<h1><?php echo Yii::t('label', 'INSTALLATION') ?></h1>

<p><?php echo Yii::t('UserModule.t', 'USER_MODULE_INSTALL_MESSAGE') ?></p>

<div class="span7">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'install-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>
        <div class="row rememberMe">
            <?php echo $form->checkBox($model, 'install'); ?>
            <?php echo $form->label($model, 'install'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('label', 'INSTALL')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>