<?php
/* @var $this CtsSettingsController */
/* @var $data CtsSettings */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('key')); ?>:</b>
    <?php echo CHtml::encode($data->key); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('certificate')); ?>:</b>
    <?php echo CHtml::encode($data->certificate); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('validate_response_key')); ?>:</b>
    <?php echo CHtml::encode($data->validate_response_key); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('callback_url')); ?>:</b>
    <?php echo CHtml::encode($data->callback_url); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('login_url')); ?>:</b>
    <?php echo CHtml::encode($data->login_url); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('asserationNS')); ?>:</b>
    <?php echo CHtml::encode($data->asserationNS); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
    <?php echo CHtml::encode($data->prefix); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('issuer')); ?>:</b>
    <?php echo CHtml::encode($data->issuer); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('is_default')); ?>:</b>
    <?php echo CHtml::encode($data->is_default); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
    <?php echo CHtml::encode($data->create_user_id); ?>
    <br/>
    <b><?php echo CHtml::encode($data->getAttributeLabel('create_datetime')); ?>:</b>
    <?php echo CHtml::encode($data->create_datetime); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?>
	<br />

	*/ ?>

</div>