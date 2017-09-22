<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => 'Lista Exceptii', 'icon' => 'list', 'url' => ['admin']],
    ['label' => 'Creare Exceptie Logare', 'icon' => 'plus-circle', 'url' => ['create']],
    ['label' => 'Actualizare Exceptie ' . $model->title, 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id]],
];
$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Exceptii logare' => ['loginException/admin'],
    'Vizualizare Exceptie ' . $model->title
];
?>

<div class="page-header">
    <h1> Vizualizare Exceptie <?php echo $model->title; ?></h1>
</div>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'title',
        'action',
        [
            'name' => 'type',
            'value' => $model->type == 1 ? 'Fara Parametri' : 'Cu Parametri',
        ],
        [
            'name' => 'create_user_id',
            'value' => CHtml::encode($model->userCreate->username),
        ],
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
