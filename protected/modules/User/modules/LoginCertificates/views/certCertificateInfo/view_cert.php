<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */

$this->breadcrumbs = array(
    'Cert Certificate Infos' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Download Key', 'icon'=>'download', 'url' => array('downloadKey', 'id' => $model->id)),
    array('label' => 'Manage CertCertificateInfo', 'icon'=>'list', 'url' => array('admin')),
);
?>

<h1>View CertCertificateInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'user_id',
        'countryName',
        'stateOrProvinceName',
        'localityName',
        'organizationName',
        'organizationalUnitName',
        'commonName',
        'emailAddress',
        'passphrase',
        'cert_crt',
        'cert_key',
    ),
)); ?>