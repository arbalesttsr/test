<?php
/* @var $this CertCertificateInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Cert Certificate Infos',
);

$this->menu = array(
    array('label' => 'Create CertCertificateInfo', 'url' => array('create')),
    array('label' => 'Manage CertCertificateInfo', 'url' => array('admin')),
);
?>

<h1>Cert Certificate Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
