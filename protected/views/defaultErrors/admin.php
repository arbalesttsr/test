<?php
/* @var $this DefaultErrorsController */
/* @var $model DefaultErrors */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Manage Default Errors',
];

$this->menu = [
    ['label' => 'Create DefaultErrors','icon' => 'plus', 'url' => ['create']],
];

?>

<h1>Manage Default Errors</h1>


<?php $this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => 'default-errors-grid',
    'afterAjaxUpdate' => "function(){location.reload(true)}",
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        //'id',
        'code',
        'type',
        'error_code',
        'message',
        //'create_user_id',
        /*
        'create_datetime',
        'update_user_id',
        'update_datetime',
        */
        /*array(
            'class'=>'CButtonColumn',
        ),*/
    ],
]); ?>
