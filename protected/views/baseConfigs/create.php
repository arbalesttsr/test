<?php
/* @var $this BaseConfigsController */
/* @var $model BaseConfigs */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Create',
];

$this->menu = [
    ['label' => 'Manage BaseConfigs', 'icon' => 'list', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>Create BaseConfigs</h1>
    </div>

<?php $this->renderPartial('_form', ['model' => $model]); ?>