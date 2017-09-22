<?php
/* @var $this UserLdapRelationController */
/* @var $model UserLdapRelation */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess','create'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'MANAGE_USER_LDAP_RELATION'), 'icon' => 'list', 'url' => array('admin')),
);

if (isset($_GET['ldapid']))
    $ldap_id = $_GET['ldapid'];
else {
    $ldap_id = NULL;
}
?>

    <h1><?= Yii::t('mess', 'CREATE_USER_LDAP_RELATION') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'ldap_id' => $ldap_id)); ?>