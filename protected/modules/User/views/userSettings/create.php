<?php
/* @var $this UserSettingsController */
/* @var $model UserSettings */

$this->breadcrumbs = array(
    'User Settings' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List UserSettings', 'url' => array('index')),
    array('label' => 'Manage UserSettings', 'url' => array('admin')),
);
?>

    <h1>Create UserSettings</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>