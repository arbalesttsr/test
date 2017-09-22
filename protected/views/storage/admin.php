<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    //array('label'=>Yii::t('mess','list') . Yii::t('mess','storages'), 'url'=>array('index')),
    ['label' => Yii::t('mess', 'create') . Yii::t('mess', 'storages'), 'icon' => 'plus', 'url' => ['create']],
    ['label' => Yii::t('mess', 'SYNAPSIS_STORAGE'), 'icon' => 'folder-open', 'url' => ['storage']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('mess', 'manage') . Yii::t('mess', 'storages')

];

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('storage-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h1><?php echo Yii::t('mess', 'manage') . Yii::t('mess', 'storages'); ?></h1>
</div>

<!--<p>
<?php echo Yii::t('mess', 'textFromAdminManagePage'); ?>
</p>-->

<?php echo CHtml::link(Yii::t('mess', 'AdvancedSearch'), '#', ['class' => 'search-button']); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', [
        'model' => $model,
    ]); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => 'storage-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'name',
        'path',
        [
            'name' => 'directory_exists',
            'value' => '$data->directory_exists ?
                        "<span title=\'true\' style=\'margin: 0 45% auto; padding: 2px;\' class=\'fa fa-check btn-success\'><i></i></span>" :
                        "<span title=\'false\' style=\'margin: 0 45% auto; padding: 2px;\' class=\'fa fa-minus-circle btn-danger\'><i></i></span>"',
            'type' => 'html'
        ],
        //'folder_rights',
        [
            'name' => 'directory_rights',
            'value' => '$data->directory_exists ?
                        "<span style=\'margin: 0 44% auto;\'>" . $data->directory_rights . "</span>" : 
                        "<span title=\'false\' style=\'margin: 0 45% auto;\' class=\'btn-action glyphicons circle_minus btn-danger\'><i></i></span>"',
            'type' => 'html'
        ],
        [
            'name' => 'create_user_id',
            'value' => '$data->userCreate->username',
        ],
        //'create_user_id',
        'create_datetime',
        //'update_user_id',
        /*
        'update_datetime',
        */
        /*array(
            'class'=>'bootstrap.widgets.BsButtonColumn',
        ),*/
    ],
]); ?>
