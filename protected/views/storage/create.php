<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'storages'), 'icon' => 'list', 'url' => ['admin']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'storages') => ["/storage/admin"],
    Yii::t('mess', 'create') . Yii::t('mess', 'storages')
];
?>

    <div class="page-header">
        <h1><?php echo Yii::t('mess', 'create') . Yii::t('mess', 'storages'); ?></h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>