<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','create'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'MANAGE_LDAP_SETTINGS'), 'icon' => 'list', 'url' => array('admin')),
);
?>

    <h1><?= Yii::t('mess','CREATE_LDAP_SETTINGS') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model,)); ?>