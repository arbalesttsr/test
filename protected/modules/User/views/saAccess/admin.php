<?php
/* @var $this SaAccessController */
/* @var $model SaAccess */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('mess','Sa Accesses') => array('/User/SaAccess/admin'),
    Yii::t('mess','manage'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'create') . ' ' . get_class($model), 'icon'=>'plus', 'url' => array('/User/SaAccess/create')),
    array('label' => Yii::t('mess', 'manage') . ' ' . get_class($model), 'icon'=>'list', 'url' => array('/User/SaAccess/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sa-access-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link(Yii::t('mess', 'adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'sa-access-grid',
    'hide_btns' => true,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        'ip',
        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{viewSA}{updateSA}{deleteSA}',
            'buttons' => array(
                'viewSA' => array(
                    'url' => 'Yii::app()->createUrl("User/saAccess/view", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-eye", 'title' => Yii::t('mess', 'view')),
					'label' => '',
                ),
                'updateSA' => array(
                    'url' => 'Yii::app()->createUrl("User/saAccess/update", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-edit", 'title' => Yii::t('mess', 'update')),
					'label' => '',
                ),
                'deleteSA' => array(
                    'url' => 'Yii::app()->createUrl("User/saAccess/delete", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-remove", 'title' => Yii::t('mess', 'delete')),
					'label' => '',
                ),
            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
