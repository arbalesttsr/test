<?php
/* @var $this UserLdapRelationController */
/* @var $model UserLdapRelation */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    $model->id, 
	Yii::t('mess','view'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_USER_LDAP_RELATION'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('mess', 'UPDATE_USER_LDAP_RELATION'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('mess', 'MANAGE_USER_LDAP_RELATION'), 'icon' => 'list', 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','View UserLdapRelation') ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        //'user_id',
        array(
            'name' => 'user_id',
            'type' => 'raw',
            'value' => (CHtml::encode($model->user->username)),
        ),
        //'ldap_setting_id',
        array(
            'name' => 'ldap_setting_id',
            'type' => 'raw',
            'value' => (CHtml::encode($model->ldapSetting->ldap_host)),
        ),
        //'create_user_id',
        array(
            'name' => 'create_user_id',
            'type' => 'raw',
            'value' => (CHtml::encode($model->user_create->username)),
        ),
        'create_datetime',
        'update_user_id',
        'update_datetime',
    ),
)); ?>
