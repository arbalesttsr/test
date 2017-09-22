<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'storages'), 'icon' => 'list', 'url' => ['admin']],
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'storages'), 'icon' => 'plus', 'url' => ['create']],
    ['label' => Yii::t('mess', 'update') . Yii::t('mess', 'storages'), 'icon' => 'edit', 'url' => ['update', 'id' => $model->id]],
    ['label' => Yii::t('mess', 'create_dir'), 'icon' => 'folder_plus', 'url' => ['createDir', 'id' => $model->id], 'visible' => !$model->directory_exists]
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'storages') => ["/storage/admin"],
    Yii::t('mess', 'view') . Yii::t('mess', 'storage') . ' #' . $model->id
];
?>

<div class="page-header">
    <h1><?php echo Yii::t('mess', 'view') . Yii::t('mess', 'storage'); ?> #<?php echo $model->id; ?></h1>
</div>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'name',
        'path',
        'directory_rights',
        //'create_user_id',
        [
            'name' => 'create_user_id',
            'value' => CHtml::encode($model->userCreate->username),
        ],
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ],
]); ?>
