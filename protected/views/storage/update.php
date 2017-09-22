<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'storages'), 'icon' => 'list', 'url' => ['admin']],
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'storages'), 'icon' => 'plus', 'url' => ['create']],
    ['label' => Yii::t('mess', 'view') . Yii::t('mess', 'storages'), 'icon' => 'eye', 'url' => ['view', 'id' => $model->id]],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'storages') => ["/storage/admin"],
    Yii::t('mess', 'update') . Yii::t('mess', 'storage') . ' #' . $model->id
];
?>

    <div class="page-header">
        <h1><?php echo Yii::t('mess', 'update') . Yii::t('mess', 'storages'); ?><?php echo $model->id; ?></h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>