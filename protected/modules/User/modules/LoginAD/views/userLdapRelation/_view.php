<?php
/* @var $this UserLdapRelationController */
/* @var $data UserLdapRelation */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user->username); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ldap_setting_id')); ?>:</b>
    <?php echo CHtml::encode($data->ldapSetting->ldap_host); ?>
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