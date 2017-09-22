<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('UserModule.t', 'MANAGE_USERS')
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'icon' => 'plus-circle', 'url' => array('register')),
    array('label' => Yii::t('UserModule.t', 'ACTIVE_ALL_USERS'), 'icon' => 'check-square', 'url' => array('activeAllUsers'), 'visible' => Yii::app()->user->isSa()),
    array('label' => Yii::t('UserModule.t', 'BLOCK_ALL_USERS'), 'icon' => 'ban', 'url' => array('banAllUsers'), 'visible' => Yii::app()->user->isSa()),
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
    <h1><?php echo Yii::t('UserModule.t', 'MANAGE_USERS'); ?></h1>
</div>

<?php echo CHtml::link(Yii::t('mess', 'adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $user,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'user-grid',
    'hide_btns' => true,
    'dataProvider' => $user->search(),
    'filter' => $user,
    'columns' => array(
        //'id',
        'username',
        'profile.firstname',
        'profile.lastname',
        'ad_username',

        'idnp',
        'sql_user' => array(
            //'header' => 'Sql User',
            'name' => 'sql_user',
            'visible' => User::checkClientLogin(),
            'value' => '(User::GetDbSqlUsername($data->username) !=="Not Set")? "Yes" : "No"',
            'filter' => array('0' => 'No', '1' => 'Yes'),
            // 'htmlOptions' => array('style' => "text-align:center;"),
        ),

        'status_id' => array(
            // 'header' => 'Status',
            'name' => 'status_id',

            'value' => '($data->status_id == 0) ? "Blocat" : "Activ"',
            'filter' => array('0' => 'Blocat', '1' => 'Activ'),
            'htmlOptions' => array('style' => "text-align:center;"),
        ),
        'create_user_id' => array(
            'name' => 'create_user_id',
            'value' => 'User::model()->findByPk($data->create_user_id)->username',
            'filter' => CHtml::listData(User::model()->findAll(), 'id', 'username')
        ),
        //'create_datetime',
        //'update_user_id',
        //'update_date',

        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{profile}{updateUser}{deleteUser}{activate}{block}',
            'buttons' => array(
                'profile' => array(
                    'url' => 'Yii::app()->createUrl("User/user/userDetails", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-user", 'title' => Yii::t('UserModule.t', 'PROFILE')),
                    'label' => '',
                ),
                'updateUser' => array(
                    'url' => 'Yii::app()->createUrl("User/user/userDetailsUpdate", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-edit", 'title' => Yii::t('mess', 'update')),
					'label' => '',
                ),

                'deleteUser' => array(
                    'url' => 'Yii::app()->createUrl("User/user/delete", array("id"=>$data->id))',
                    'options' => array('class' => "fa fa-remove", 'title' => Yii::t('mess', 'delete')),
					'label' => '',
                ),
                'activate' => array(
                    'url' => 'Yii::app()->createUrl("User/user/activateUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-check-square", 'title' => Yii::t('mess', 'ACTIVATE')),
                    'label' => '',
                    'visible' => '($data->status_id===0 &&( Yii::app()->getUser()->isSa() or User::ADMIN))?true:false;'
                ),
                'block' => array(
                    'url' => 'Yii::app()->createUrl("User/user/blockUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#e73c3c;', 'class' => "fa fa-ban", 'title' => Yii::t('mess', 'BLOCK')),
                    'label' => '',
                    'visible' => '($data->status_id===1 && ( Yii::app()->getUser()->isSa() or User::ADMIN))?true:false;'
                ),
            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
