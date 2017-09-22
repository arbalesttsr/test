<?php
/* @var $this PasswordController */
/* @var $model PasswordForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Reset Password';
$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon' => 'list', 'url' => array('/User/user/admin'), 'visible' => Yii::app()->user->isSa()),
);

$this->breadcrumbs = array(
    $this->module->id => array("/{$this->module->id}/default/administration"),
    Yii::t('UserModule.t', 'RESET_PASSWORD'),
);

?>
<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="page-header">
        <h1><?php echo Yii::app()->user->getFlash('success') ?></h1>
    </div>
<?php else: ?>
    <div class="page-header">
        <h1><?php echo Yii::t('UserModule.t', 'RESET_PASSWORD') ?></h1>
    </div>
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'password-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>
        <?php
        if ($msg !== '')
            echo '<div class="alert alert-dismissable alert-warning">' . '<strong>Warning!</strong>' . $msg . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                . '</div>';
        ?>
        <?php //echo Yii::t('base', 'FIELDS_ARE_REQUIRED')?>
        <?php echo $form->hiddenField($model, 'currentPassword', array('value' => 'password', 'placeholder' => Yii::t('UserModule.t', 'CURRENT_PASSWORD'))); ?>
        <!--	<div class="row">
		<?php //echo $form->labelEx($model,'currentPassword'); ?>
		<?php echo $form->hiddenField($model, 'currentPassword', array('placeholder' => Yii::t('UserModule.t', 'CURRENT_PASSWORD'))); ?>
		<?php echo $form->error($model, 'currentPassword'); ?>
	</div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'newPassword'); ?>
            <?php echo $form->passwordField($model, 'newPassword', array('placeholder' => Yii::t('UserModule.t', 'NEW_PASSWORD'))); ?>
            <?php echo $form->error($model, 'newPassword'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'comparePassword'); ?>
            <?php echo $form->passwordField($model, 'comparePassword', array('placeholder' => Yii::t('UserModule.t', 'REPEAT_PASSWORD'))); ?>
            <?php echo $form->error($model, 'comparePassword'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('mess', 'reset')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
<?php endif; ?>

