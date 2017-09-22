<?php
/* @var $this ModulesDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'ModulesData',
];

$this->menu = [
    //array('label'=>'Create ModulesData', 'url'=>array('create')),
    ['label' => 'Manage ModulesData', 'url' => ['admin']],
];
?>

<h1>ModulesData</h1>

<?php $this->widget('application.components.widgets.usertheme.UserListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]); ?>
