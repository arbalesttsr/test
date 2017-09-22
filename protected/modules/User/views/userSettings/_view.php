<?php
/* @var $this UserSettingsController */
/* @var $data UserSettings */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br/>


    <b><?php echo CHtml::encode($data->getAttributeLabel('time_limit')); ?>:</b>
    <?php echo CHtml::encode($data->time_limit); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('restricted_id')); ?>:</b>
    <?php echo CHtml::encode($data->restricted_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('restricted_days')); ?>:</b>
    <?php echo CHtml::encode($data->restricted_days); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('restricted_date')); ?>:</b>
    <?php echo CHtml::encode($data->restricted_date); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('restricted_interval')); ?>:</b>
	<?php echo CHtml::encode($data->restricted_interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_start')); ?>:</b>
	<?php echo CHtml::encode($data->date_start); ?>
	<br />

	*/ ?>

</div>