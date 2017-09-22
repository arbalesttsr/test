<?php
/* @var $this ProfileController */
/* @var $data Profile */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->firstname), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->lastname), array('view', 'id' => $data->id)); ?>
    <br/>

</div>

