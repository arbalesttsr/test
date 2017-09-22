<?php
/* @var $this ModulesDataController */
/* @var $model ModulesData */

$this->breadcrumbs = [
    'ModulesData' => ['index'],
    $model->name,
];

$this->menu = [
    ['label' => 'List ModulesData', 'url' => ['index']],
    //array('label'=>'Create ModulesData', 'url'=>array('create')),
    //array('label'=>'Update ModulesData', 'url'=>array('update', 'id'=>$model->id)),
    ['label' => 'Delete ModulesData', 'url' => '#', 'htmlOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?']],
    ['label' => 'Manage ModulesData', 'url' => ['admin']],
];
?>

<h1>View ModulesData #<?php echo $model->id; ?></h1>

<?php //$this->widget('bootstrap.widgets.BsDetailView', array(
$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'name',
        'activ',
        'create_user_id',
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
