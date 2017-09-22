<?php
/* @var $this DefaultErrorsController */
/* @var $model DefaultErrors */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Create DefaultErrors',
];

$this->menu = [
    ['label' => 'Manage DefaultErrors', 'icon' => 'list', 'url' => ['admin']],
];
?>

    <h1>Create DefaultErrors</h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>