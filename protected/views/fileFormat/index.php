<?php
/* @var $this FilesFormatsController */
/* @var $dataProvider CActiveDataProvider */


$this->menu = [
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'filesformats'), 'url' => ['create']],
    ['label' => Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats'), 'url' => ['admin']],
];
?>

<div class="page-header">
    <h1>Files Formats</h1>
</div>

<?php $this->widget('application.components.widgets.usertheme.UserListView', [
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
]); ?>
