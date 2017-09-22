<?php
/* @var $this CertCertificateInfoController */
/* @var $model CertCertificateInfo */

$this->breadcrumbs = array(
    'Cert Certificate Infos' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Create CertCertificateInfo', 'icon'=>'plus', 'url' => array('create')),
    array('label' => 'View CertCertificateInfo', 'icon'=>'eye', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage CertCertificateInfo', 'icon'=>'list', 'url' => array('admin')),
);
?>

    <h1>Update CertCertificateInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>