<?php
/* @var $this StorageController */
/* @var $dataProvider CActiveDataProvider */

$this->menu = [
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'storages'), 'url' => ['create']],
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'storages'), 'url' => ['admin']],
];
?>

<div class="page-header">
    <h1><?php echo Yii::t('mess', 'storages'); ?></h1>
</div>

<?php $this->widget('application.components.widgets.usertheme.UserListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]); ?>
