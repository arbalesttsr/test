<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */

$this->breadcrumbs = array(
    $this->module->name => array("{$this->module->id}/default/administration"),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('mess','update'),
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_LDAP_SETTINGS'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('mess', 'VIEW_LDAP_SETTINGS'), 'icon' => 'eye', 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('mess', 'MANAGE_LDAP_SETTINGS'), 'icon' => 'list', 'url' => array('admin')),
);
?>

    <h1><?= Yii::t('mess','Update LdapSettings') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>