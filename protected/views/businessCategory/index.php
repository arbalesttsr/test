<?php
/* @var $this BusinessCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Business Categories',
];

$this->menu = [
    ['label' => 'Create BusinessCategory', 'url' => ['create']],
    ['label' => 'Manage BusinessCategory', 'url' => ['admin']],
];
?>

<h1>Business Categories</h1>

<?php $this->widget('zii.widgets.CListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]); ?>
