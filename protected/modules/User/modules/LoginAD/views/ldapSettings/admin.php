<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess', 'manage'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_LDAP_SETTINGS'), 'icon' => 'plus-circle', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ldap-settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?= Yii::t('mess', 'MANAGE_LDAP_SETTINGS') ?></h1>

<?php echo CHtml::link(Yii::t('mess','adv_search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'ldap-settings-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'ldap_host',
        'ldap_port',
        'ldap_dc',
        'ldap_ou',

        /*array(
                array(
                'class'=>'zii.widgets.grid.CButtonColumn',
                    'template'=>'{add}',
                    'buttons'=>array(

                        'add' => array(
                            'options'=>array('class'=>"fa fa-cogs", 'title' => 'Config User'),
                            'label'=>'<i></i>',
                            'url'=>'Yii::app()->createUrl("User/LoginAD/userLdapRelation/create", array("ldapid"=>$data->id))',
                        ),
                    ),
                    'htmlOptions' => array('style'=>'width: 50px'),
                    )
                )*/
    ),//'hide_btns'=>true,
)); ?>
