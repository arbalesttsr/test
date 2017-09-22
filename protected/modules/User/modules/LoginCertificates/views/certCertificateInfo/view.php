<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->id => array("{$this->module->id}/default/administration"),
    $model->id,
);

$this->menu = array(
    array('label' => 'Download Key', 'icon'=>'download', 'url' => array('downloadKey', 'id' => $model->id)),
    array('label' => 'Create CertCertificateInfo', 'icon'=>'plus', 'url' => array('create')),
    array('label' => 'Update CertCertificateInfo', 'icon'=>'edit', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage CertCertificateInfo', 'icon'=>'list', 'url' => array('admin')),
);
?>

<h1>View CertCertificateInfo #<?php echo $model->user->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array
        (
            'name'=>'User',
            'type'=>'raw',
            'value'=>$model->user->username,
        ),
        'country_name',
        'state_or_province_name',
        'locality_name',
        'organization_name',
        'organizational_unit_name',
        'common_name',
        'email_address',
        'passphrase',
        'cert_crt',
        'cert_key',
    ),
)); ?>
