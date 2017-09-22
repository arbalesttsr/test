<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    $model->id,
);

$this->menu = array(
    array('label' => Yii::t('mess', 'CREATE_LDAP_SETTINGS'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('mess', 'Update LdapSettings'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('mess', 'MANAGE_LDAP_SETTINGS'), 'icon' => 'list', 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','VIEW_LDAP_SETTINGS') ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'ldap_host',
        'ldap_port',
        'ldap_dc',
        'ldap_ou',
    ),
)); ?>
