<?php
/* @var $this LoginExceptionController */
/* @var $model LoginException */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'login-exception-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <p class="note"><?php echo Yii::t('mess', 'fields_required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', ['size' => 60, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'action'); ?>
        <?php echo $form->textField($model, 'action', ['size' => 60, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'action'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', LoginException::getDataTypes()); ?>
        <?php echo $form->error($model, 'action'); ?>
    </div>
    <!--	<?php /* ?><div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->hiddenField($model,'create_user_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_datetime'); ?>
		<?php echo $form->hiddenField($model,'create_datetime'); ?>
		<?php echo $form->error($model,'create_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_datetime'); ?>
		<?php echo $form->textField($model,'update_datetime'); ?>
		<?php echo $form->error($model,'update_datetime'); ?>
	</div><?php */ ?>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->