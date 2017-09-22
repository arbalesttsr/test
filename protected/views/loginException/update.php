<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'storages'), 'icon' => 'list', 'url' => ['admin']],
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'storages'), 'icon' => 'plus-circle', 'url' => ['create']],
    ['label' => Yii::t('mess', 'view') . Yii::t('mess', 'storages'), 'icon' => 'eye', 'url' => ['view', 'id' => $model->id]],
];
$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Exceptii logare' => ['loginException/admin'],
    'Actualizare Exceptie ' . $model->title
];
?>

    <div class="page-header">
        <h1>Actualizare Exceptie <?php echo $model->title; ?></h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>