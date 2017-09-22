<?php
/* @var $this LdapSettingsController */
/* @var $data LdapSettings */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ldap_host')); ?>:</b>
    <?php echo CHtml::encode($data->ldap_host); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ldap_port')); ?>:</b>
    <?php echo CHtml::encode($data->ldap_port); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ldap_dc')); ?>:</b>
    <?php echo CHtml::encode($data->ldap_dc); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('ldap_ou')); ?>:</b>
    <?php echo CHtml::encode($data->ldap_ou); ?>
    <br/>


</div>