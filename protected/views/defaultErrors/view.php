<?php
/* @var $this DefaultErrorsController */
/* @var $model DefaultErrors */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Error #' . $model->id,
];

$this->menu = [
    ['label' => 'Create DefaultErrors', 'icon' => 'plus', 'url' => ['create']],
    ['label' => 'Update DefaultErrors', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Manage DefaultErrors', 'icon' => 'list', 'url' => ['admin']],
];
?>

<h1>View DefaultErrors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'code',
        'type',
        'error_code',
        'message',
        'create_user_id',
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
