<?php
/* @var $this ModulesDataController */
/* @var $data ModulesData */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), ['view', 'id' => $data->id]); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('activ')); ?>:</b>
    <?php echo CHtml::encode($data->activ); ?>
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