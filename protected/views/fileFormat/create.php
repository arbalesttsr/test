<?php
/* @var $this FilesFormatsController */
/* @var $model FilesFormats */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','filesformats'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats'), 'icon' => 'list', 'url' => ['admin']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats') => ["/fileFormat/admin"],
    Yii::t('mess', 'create') . Yii::t('mess', 'filesformats')
];
?>

    <div class="page-header">
        <h1><?php echo Yii::t('mess', 'create') . Yii::t('mess', 'filesformats'); ?></h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>