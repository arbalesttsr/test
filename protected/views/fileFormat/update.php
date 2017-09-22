<?php
/* @var $this FilesFormatsController */
/* @var $model FilesFormats */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','filesformats'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats'), 'icon' => 'list', 'url' => ['admin']],
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'filesformats'), 'icon' => 'circle_plus', 'url' => ['create']],
    ['label' => Yii::t('mess', 'view') . Yii::t('mess', 'filesformats'), 'icon' => 'circle_remove', 'url' => ['view', 'id' => $model->id]],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats') => ["/fileFormat/admin"],
    Yii::t('mess', 'update') . Yii::t('mess', 'filesformats') . ' #' . $model->id
];
?>

    <div class="page-header">
        <h1><?php echo Yii::t('mess', 'update') . Yii::t('mess', 'filesformats'); ?><?php echo $model->id; ?></h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>