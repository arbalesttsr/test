<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    Yii::t('UserModule.t','PROFILES') => array('User/profile/admin'),
    Yii::t('mess','manage'),
);

$this->menu = array(
//	array('label'=>'List Profile', 'url'=>array('index')),
    //array('label'=>Yii::t('UserModule.user','Create Profile'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#profile-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h3><?php echo Yii::t('UserModule.t', 'MANAGE_PROFILES') ?></h3>
</div>

<?php echo CHtml::link(Yii::t('mess', 'adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.UserGridView', array(
    'id' => 'profile-grid',
    'hide_btns' => true,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'user_id' => array(
            'name' => 'user_id',
            'value' => 'CHtml::link(
								$data->user->username,
								array("user/view","id"=>$data->id))',
            'type' => 'raw',
        ),
        'firstname' => array(
            'name' => 'firstname',
            'value' => 'CHtml::link(
								$data->firstname,
								array("view","id"=>$data->id))',
            'type' => 'raw',
        ),
        'lastname' => array(
            'name' => 'lastname',
            'value' => 'CHtml::link(
								$data->lastname,
								array("view","id"=>$data->id))',
            'type' => 'raw',
        ),
        'patronymic' => array(
            'name' => 'patronymic',
            'value' => 'CHtml::link(
							$data->patronymic,
							array("view","id"=>$data->id))',
            'type' => 'raw',
        ),
        'email',
        'subsidiary_id' => array(
            'name' => 'subsidiary_id',
            'value' => '($data->subsidiary)?$data->subsidiary->name:null',
            'type' => 'raw',
        ),
        'department_id' => array(
            'name' => 'department_id',
            'value' => '($data->department)?$data->department->name:null',
            'type' => 'raw',
        ),
        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{viewProf}{updateProf}{deleteProf}{userProf}',
            'buttons' => array(
                'viewProf' => array(
                    'url' => 'Yii::app()->createUrl("User/profile/view", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-eye", 'title' => Yii::t('mess', 'view')),
					'label' => '',
                ),
                'updateProf' => array(
                    'url' => 'Yii::app()->createUrl("User/profile/edit", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-edit", 'title' => Yii::t('mess', 'update')),
					'label' => '',
                ),
                'deleteProf' => array(
                    'url' => 'Yii::app()->createUrl("User/profile/delete", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-remove", 'title' => Yii::t('mess', 'delete')),
					'label' => '',
                ),
                'userProf' => array(
                    'url' => 'Yii::app()->createUrl("User/profile/view", array("id"=>$data->id))',
                    'options' => array('class' => "btn-action glyphicons user btn-primary", 'title' => Yii::t('UserModule.t', 'PROFILE')),
                    'label' => '<i></i>',
                ),
            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    )
)); ?>
