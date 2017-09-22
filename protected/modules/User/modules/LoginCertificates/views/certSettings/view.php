<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->id => array("{$this->module->id}/default/administration"),
    $model->id,
);

$this->menu = array(
    array('label' => 'Create CertSettings', 'icon'=>'plus', 'url' => array('create')),
    array('label' => 'Update CertSettings', 'icon'=>'edit', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Manage CertSettings', 'icon'=>'list', 'url' => array('admin')),
);
?>

<h1>View CertSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'certificates_path',
        'key_path',
        'openssl_config_path',
        'digest_alg',
        'private_key_bits',
        'private_key_type',
    ),
)); ?>
