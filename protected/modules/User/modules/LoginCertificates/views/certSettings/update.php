<?php
/* @var $this CertSettingsController */
/* @var $model CertSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->id => array("{$this->module->id}/default/administration"),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Create CertSettings', 'icon'=>'plus', 'url' => array('create')),
    array('label' => 'View CertSettings', 'icon'=>'eye', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage CertSettings', 'icon'=>'list', 'url' => array('admin')),
);
?>

    <h1>Update CertSettings <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>