<?php
/* @var $this UserLdapRelationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_USER_LDAP_RELATION'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('mess', 'MANAGE_USER_LDAP_RELATION'), 'icon' => 'list', 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','User Ldap Relations') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
