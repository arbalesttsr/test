<?php
/* @var $this FilesFormatsController */
/* @var $model FilesFormats */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'files-formats-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <p class="note"><?php echo Yii::t('mess', 'fields_required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', ['size' => 50, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'extension'); ?>
        <?php echo $form->textField($model, 'extension', ['size' => 50, 'maxlength' => 50]); ?>
        <?php echo $form->error($model, 'extension'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content_type'); ?>
        <?php echo $form->textField($model, 'content_type', ['size' => 50, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'content_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'icon'); ?>
        <?php echo $form->fileField($model, 'icon'); ?>
        <?php echo $form->error($model, 'icon'); ?>
    </div>

    <!--	<div class="row">
		<?php echo $form->labelEx($model, 'create_user_id'); ?>
		<?php echo $form->textField($model, 'create_user_id', ['size' => 20, 'maxlength' => 20]); ?>
		<?php echo $form->error($model, 'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'create_datetime'); ?>
		<?php echo $form->textField($model, 'create_datetime'); ?>
		<?php echo $form->error($model, 'create_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'update_user_id'); ?>
		<?php echo $form->textField($model, 'update_user_id', ['size' => 20, 'maxlength' => 20]); ?>
		<?php echo $form->error($model, 'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'update_datetime'); ?>
		<?php echo $form->textField($model, 'update_datetime'); ?>
		<?php echo $form->error($model, 'update_datetime'); ?>
	</div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess', 'create') : Yii::t('mess', 'save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->