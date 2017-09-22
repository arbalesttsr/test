<?php
/* @var $this BaseConfigsController */
/* @var $model BaseConfigs */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Manage Administrare constante',
];

$this->menu = [
    ['label' => 'Create BaseConfigs', 'icon' => 'plus', 'url' => ['create']],
];
?>

<div class="page-header">
    <h1>Manage Base Configs</h1>
</div>


<?php $this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => 'base-configs-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'config_label',
        'config_value',
        [
            'name' => 'create_user_id',
            'type' => 'raw',
            'value' => '$data->create_user_id0->username',
        ],
        [
            'name' => 'update_user_id',
            'type' => 'raw',
            'value' => 'isset($data->update_user_id0->username)?$data->update_user_id0->username:"Nu e setat"',
        ],
        'create_datetime',
        /*
        'update_user_id',
        'update_datetime',
        array(
            'class'=>'CButtonColumn',
        ),
        */
    ],
]); ?>
