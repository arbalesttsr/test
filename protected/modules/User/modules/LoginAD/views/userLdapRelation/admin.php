<?php
/* @var $this UserLdapRelationController */
/* @var $model UserLdapRelation */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','manage'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_USER_LDAP_RELATION'), 'icon' => 'plus-circle', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-ldap-relation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess','MANAGE_USER_LDAP_RELATION') ?></h1>


<?php echo CHtml::link(Yii::t('mess','adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'user-ldap-relation-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',

        //'user_id',
        'user_id' => array(
            'name' => 'user_id',
            'value' => '$data->user->username',
        ),
        'ldap_setting_id' => array(
            'name' => 'ldap_setting_id',
            'value' => '$data->ldapSetting->ldap_host',
        ),
        //'ldap_setting_id',
        'create_user_id',
        'create_datetime',
        //'update_user_id',
        /*
        'update_datetime',
        */
        /*array(
            'class'=>'zii.widgets.grid.CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array(
                'view' => array(
                    'url'=>'Yii::app()->createUrl("User/user/view", array("id"=>$data->id))',
                    'options'=>array('title'=>Yii::t('label','VIEW')),
                ),
                'update' => array(
                    'url'=>'Yii::app()->createUrl("User/user/update", array("id"=>$data->id))',
                    'options'=>array('title'=>Yii::t('label','UPDATE')),
                ),
                'delete' => array(
                    'url'=>'Yii::app()->createUrl("User/user/delete", array("id"=>$data->id))',
                    'options'=>array('title'=>Yii::t('label','DELETE')),
                ),
            ),
            'htmlOptions' => array('style'=>'width: 50px'),
        )*/
    ),
)); ?>
