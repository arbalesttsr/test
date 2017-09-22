<?php
/* @var $this BusinessCategoryController */
/* @var $model BusinessCategory */

$this->breadcrumbs = [
    'Business Categories' => ['index'],
    $model->name => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List BusinessCategory', 'url' => ['index']],
    ['label' => 'Create BusinessCategory', 'url' => ['create']],
    ['label' => 'View BusinessCategory', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage BusinessCategory', 'url' => ['admin']],
];
?>

    <h1>Update BusinessCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', ['model' => $model]); ?>