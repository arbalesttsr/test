<?php
/* @var $this StorageController */
/* @var $model Storage */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'storage-form',
        'enableAjaxValidation' => false,
    ]); ?>

    <p class="note"><?php echo Yii::t('mess', 'fields_required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', ['size' => 60, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'path'); ?>
        <?php echo $form->textField($model, 'path', ['size' => 60, 'maxlength' => 100]); ?>
        <?php echo $form->error($model, 'path'); ?>
    </div>
    <div class="row">
        <?php //echo CHtml::label('directory_permission', CHtml::activeId($model, 'directory_permission')); ?>
        <?php //echo CHtml::dropDownList(CHtml::activeId($model, 'directory_permission'), HelpersStorage::GetFolderPermission($model->path), HelpersStorage::ListFilePermisions()); ?>
        <?php echo $form->labelEx($model, 'directory_rights'); ?>
        <?php echo $form->dropDownList($model, 'directory_rights', HelpersStorage::ListFilePermisions()); ?>
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