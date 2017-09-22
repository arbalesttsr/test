<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS' => array("User/LoginCTS/default/administration"),
    Yii::t('mess','Manage Cts Settings') => array("User/LoginCTS/ctsSettings/admin"),
    Yii::t('mess','Update CtsSettings') .' #' . $model->id
);

$this->menu = array(
    array('label' => Yii::t('mess','Create Cts Settings'), 'icon'=>'plus', 'url' => array('/User/LoginCTS/ctsSettings/create')),
    array('label' => Yii::t('mess','View CtsSettings'), 'icon'=>'eye', 'url' => array('/User/LoginCTS/ctsSettings/view', 'id' => $model->id)),
    array('label' => Yii::t('mess','Manage Cts Settings'), 'icon'=>'list', 'url' => array('/User/LoginCTS/ctsSettings/admin')),
);
?>

    <h1><?= Yii::t('mess','Update CtsSettings') ?> <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>