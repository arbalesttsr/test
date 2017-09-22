<?php
/* @var $this ModulesDataController */
/* @var $model ModulesData */

$this->breadcrumbs = [
    'ModulesData' => ['index'],
    'Create',
];

$this->menu = [
    ['label' => 'List ModulesData', 'url' => ['index']],
    ['label' => 'Manage ModulesData', 'url' => ['admin']],
];
?>

    <h1>Create ModulesData</h1>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>