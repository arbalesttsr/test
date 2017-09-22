<?php
/* @var $this FilesFormatsController */
/* @var $data FilesFormats */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('extension')); ?>:</b>
    <?php echo CHtml::encode($data->extension); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('content_type')); ?>:</b>
    <?php echo CHtml::encode($data->content_type); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
    <?php echo CHtml::encode($data->icon); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
    <?php echo CHtml::encode($data->userCreate->username); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_datetime')); ?>:</b>
    <?php echo CHtml::encode($data->create_datetime); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->update_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->update_datetime); ?>
	<br />

	*/ ?>

</div>