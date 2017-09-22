<?php
/* @var $this FilesFormatsController */
/* @var $model FilesFormats */

$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','filesformats'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'filesformats'), 'icon' => 'plus', 'url' => ['create']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats')

];

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('files-formats-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h1><?php echo Yii::t('mess', 'manage') . Yii::t('mess', 'filesformats'); ?></h1>
</div>

<p>
    <?php echo Yii::t('mess', 'textFromAdminManagePage'); ?>
</p>

<?php echo CHtml::link(Yii::t('mess', 'AdvancedSearch'), '#', ['class' => 'search-button']); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', [
        'model' => $model,
    ]); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => 'files-formats-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'title',
        'extension',
        'content_type',
        'icon',
        //'create_user_id',
        /*
        'create_datetime',
        'update_user_id',
        'update_datetime',
        */
        /*array(
            'class'=>'bootstrap.widgets.BsButtonColumn',
        ),*/
    ],
]); ?>
