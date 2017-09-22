<?php
/* @var $this BaseConfigsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Base Configs',
];

$this->menu = [
    ['label' => 'Create BaseConfigs', 'url' => ['create']],
    ['label' => 'Manage BaseConfigs', 'url' => ['admin']],
];
?>

<h1>Base Configs</h1>

<?php $this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]); ?>
