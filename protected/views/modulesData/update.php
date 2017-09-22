<?php
/* @var $this ModulesDataController */
/* @var $model ModulesData */

$this->breadcrumbs = [
    'ModulesData' => ['index'],
    $model->name => ['view', 'id' => $model->id],
    'Update',
];

$this->menu = [
    ['label' => 'List ModulesData', 'url' => ['index']],
    ['label' => 'Create ModulesData', 'url' => ['create']],
    ['label' => 'View ModulesData', 'url' => ['view', 'id' => $model->id]],
    ['label' => 'Manage ModulesData', 'url' => ['admin']],
];
?>

    <h1>Update ModulesData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>