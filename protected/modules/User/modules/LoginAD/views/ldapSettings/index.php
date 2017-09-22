<?php
/* @var $this LdapSettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','LdapSettings'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_LDAP_SETTINGS'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('mess', 'MANAGE_LDAP_SETTINGS'), 'icon' => 'list', 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','LdapSettings') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
