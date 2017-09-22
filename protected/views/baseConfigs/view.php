<?php
/* @var $this BaseConfigsController */
/* @var $model BaseConfigs */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    $model->id,
];

$this->menu = [
    ['label' => 'List BaseConfigs', 'icon' => 'list', 'url' => ['index']],
    ['label' => 'Create BaseConfigs', 'icon' => 'plus', 'url' => ['create']],
    ['label' => 'Update BaseConfigs', 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => 'Manage BaseConfigs', 'icon' => 'plus', 'url' => ['admin']],
];
?>

<div class="page-header">
    <h1>View BaseConfigs #<?php echo $model->id; ?></h1>
</div>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'config_label',
        'config_value',
        'create_user_id',
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
