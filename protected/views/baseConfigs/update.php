<?php
/* @var $this BaseConfigsController */
/* @var $model BaseConfigs */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    $model->id => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'Create BaseConfigs', 'icon' => 'plus', 'url' => ['create']],
    ['label' => 'View BaseConfigs', 'icon' => 'eye', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage BaseConfigs', 'icon' => 'list', 'url' => ['admin']],
];
?>

    <div class="page-header">
        <h1>Update BaseConfigs <?php echo $model->id; ?></h1>
    </div>

<?php $this->renderPartial('_form', ['model' => $model]); ?>