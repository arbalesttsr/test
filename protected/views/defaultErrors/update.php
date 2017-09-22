<?php
/* @var $this DefaultErrorsController */
/* @var $model DefaultErrors */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Update DefaultErrors #' . $model->id,
];

$this->menu = [
    ['label' => 'Create DefaultErrors', 'icon' => 'plus', 'url' => ['create']],
    ['label' => 'View DefaultErrors', 'icon' => 'eye', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage DefaultErrors', 'icon' => 'list', 'url' => ['admin']],
];
?>

    <h1>Update DefaultErrors <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>