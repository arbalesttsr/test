<?php
/* @var $this UserSettingsController */
/* @var $model UserSettings */

$this->breadcrumbs = array(
    'User Settings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => Yii::t('mess','List UserSettings'), 'url' => array('index')),
    array('label' => Yii::t('mess','Create UserSettings'), 'url' => array('create')),
    array('label' => Yii::t('mess','Update UserSettings'), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('mess','Delete UserSettings'), 'url' => '#', 'htmlOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('mess','Manage UserSettings'), 'url' => array('admin')),
);
?>

<h1><?= Yii::t('mess','View UserSettings') ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'user_id',
        'time_limit',
        'restricted_id',
        'restricted_days',
        'restricted_date',
        'restricted_interval',
        'date_start',
    ),
)); ?>
