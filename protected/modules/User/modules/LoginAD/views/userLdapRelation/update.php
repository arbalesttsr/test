<?php
/* @var $this UserLdapRelationController */
/* @var $model UserLdapRelation */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->id => array("{$this->module->id}/default/administration"),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);
$this->menu = array(
    array('label' => Yii::t('LoginADModule.t', 'CREATE_USER_LDAP_RELATION'), 'icon' => 'plus-circle', 'url' => array('create')),
    array('label' => Yii::t('LoginADModule.t', 'CREATE_USER_LDAP_RELATION'), 'icon' => 'eye', 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('LoginADModule.t', 'MANAGE_USER_LDAP_RELATION'), 'icon' => 'list', 'url' => array('admin')),
);
?>

    <h1>Update UserLdapRelation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>