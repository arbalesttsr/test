<?php
/* @var $this CertCertificateInfoController */
/* @var $data CertCertificateInfo */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('countryName')); ?>:</b>
    <?php echo CHtml::encode($data->countryName); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('stateOrProvinceName')); ?>:</b>
    <?php echo CHtml::encode($data->stateOrProvinceName); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('localityName')); ?>:</b>
    <?php echo CHtml::encode($data->localityName); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('organizationName')); ?>:</b>
    <?php echo CHtml::encode($data->organizationName); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('organizationalUnitName')); ?>:</b>
    <?php echo CHtml::encode($data->organizationalUnitName); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('commonName')); ?>:</b>
	<?php echo CHtml::encode($data->commonName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emailAddress')); ?>:</b>
	<?php echo CHtml::encode($data->emailAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passphrase')); ?>:</b>
	<?php echo CHtml::encode($data->passphrase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_crt')); ?>:</b>
	<?php echo CHtml::encode($data->cert_crt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cert_key')); ?>:</b>
	<?php echo CHtml::encode($data->cert_key); ?>
	<br />

	*/ ?>

</div>