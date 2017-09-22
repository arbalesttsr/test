<?php
/* @var $this BusinessCategoryController */
/* @var $model BusinessCategory */

$this->breadcrumbs = [
    'Business Categories' => ['index'],
    $model->name,
];

$this->menu = [
    ['label' => 'List BusinessCategory', 'url' => ['index']],
    ['label' => 'Create BusinessCategory', 'url' => ['create']],
    ['label' => 'Update BusinessCategory', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Delete BusinessCategory', 'url' => '#', 'htmlOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage BusinessCategory', 'url' => ['admin']],
];
?>

<h1>View BusinessCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'name',
        'description',
        'create_user_id',
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
