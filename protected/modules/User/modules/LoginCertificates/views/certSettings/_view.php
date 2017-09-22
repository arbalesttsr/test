<?php
/* @var $this CertSettingsController */
/* @var $data CertSettings */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('certificates_path')); ?>:</b>
    <?php echo CHtml::encode($data->certificates_path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('key_path')); ?>:</b>
    <?php echo CHtml::encode($data->key_path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('openssl_config_path')); ?>:</b>
    <?php echo CHtml::encode($data->openssl_config_path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('digest_alg')); ?>:</b>
    <?php echo CHtml::encode($data->digest_alg); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('private_key_bits')); ?>:</b>
    <?php echo CHtml::encode($data->private_key_bits); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('private_key_type')); ?>:</b>
    <?php echo CHtml::encode($data->private_key_type); ?>
    <br/>


</div>