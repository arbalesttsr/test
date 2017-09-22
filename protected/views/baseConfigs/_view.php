<?php
/* @var $this BaseConfigsController */
/* @var $data BaseConfigs */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('config_label')); ?>:</b>
    <?php echo CHtml::encode($data->config_label); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('config_value')); ?>:</b>
    <?php echo CHtml::encode($data->config_value); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
    <?php echo CHtml::encode($data->create_user_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_datetime')); ?>:</b>
    <?php echo CHtml::encode($data->create_datetime); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('update_user_id')); ?>:</b>
    <?php echo CHtml::encode($data->update_user_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('update_datetime')); ?>:</b>
    <?php echo CHtml::encode($data->update_datetime); ?>
    <br/>


</div>