<?php
/* @var $this BusinessCategoryController */
/* @var $model BusinessCategory */

$this->breadcrumbs = [
    'Business Categories' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List BusinessCategory', 'url' => ['index']],
    ['label' => 'Manage BusinessCategory', 'url' => ['admin']],
];
?>

    <h1>Create BusinessCategory</h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>