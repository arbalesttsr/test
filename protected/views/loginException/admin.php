<?php
/* @var $this StorageController */
/* @var $model Storage */


$this->menu = [
    ['label' => 'Creare Exceptie Logare', 'icon' => 'plus-circle', 'url' => ['create']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Exceptii logare',
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
    <h1>Administrare Exceptii logare</h1>
</div>

<?php echo CHtml::link('Cautare avansata', '#', ['class' => 'search-button']); ?>
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
        'title',
        'action',
        [
            'name' => 'type',
            'value' => '$data->type == 1 ? "Fara Parametri" : "Cu Parametri"',
        ],
        [
            'name' => 'create_user_id',
            'value' => 'CHtml::encode($data->userCreate->username)',
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
