<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('UserModule.t', 'MANAGE_CLIENTS')
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'icon' => 'plus-circle', 'url' => array('Registration/index')),
    //array('label'=>Yii::t('UserModule.t','VIEW_USERS'), 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'MANAGE_CLIENTS'); ?></h1>
</div>

<?php echo CHtml::link(Yii::t('mess', 'adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $user,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'client-grid',
    'hide_btns' => true,
    'dataProvider' => $user->search(),
    'filter' => $user,
    'columns' => array(
        //'id',
        'username',
        'profile.firstname',
        'profile.lastname',
        'idnp',

        'status_id' => array(
            'header' => Yii::t('mess','STATUS'),
            'name' => 'status_id',

            'value' => '($data->status_id == 0) ? "Blocat" : "Activ"',
            'filter' => array('0' => 'Blocat', '1' => 'Activ'),
            'htmlOptions' => array('style' => "text-align:center;"),
        ),
        //'create_datetime',
        //'update_user_id',
        //'update_date',

        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{activate}{block}{updateCl}',
            'buttons' => array(
                'activate' => array(
                    'url' => 'Yii::app()->createUrl("User/Client/activateUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-check-square", 'title' => Yii::t('mess', 'ACTIVATE')),
                    'label' => '',
                    'visible' => '($data->status_id===0 &&( Yii::app()->getUser()->isSa() or User::ADMIN))?true:false;'
                ),
                'block' => array(
                    'url' => 'Yii::app()->createUrl("User/Client/blockUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#e73c3c;', 'class' => "fa fa-ban", 'title' => Yii::t('mess', 'BLOCK')),
                    'label' => '',
                    'visible' => '($data->status_id===1 && ( Yii::app()->getUser()->isSa() or User::ADMIN))?true:false;'
                ),
                'updateCl' => array(
                    'url' => 'Yii::app()->createUrl("User/client/userDetailsUpdate", array("id"=>$data->id))',
                    'options' => array( 'class' => "fa fa-edit", 'title' => Yii::t('mess', 'update')),
					'label' => '',
                ),
            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
