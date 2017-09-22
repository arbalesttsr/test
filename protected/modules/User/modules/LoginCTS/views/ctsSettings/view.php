<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS' => array("User/LoginCTS/default/administration"),
    Yii::t('mess','Manage Cts Settings') => array("User/LoginCTS/ctsSettings/admin"),
    Yii::t('mess','View CtsSettings'). ' #' . $model->id
);

$this->menu = array(
    array('label' => Yii::t('mess','Create Cts Settings'), 'icon'=>'plus', 'url' => array('/User/LoginCTS/ctsSettings/create')),
    array('label' => Yii::t('mess','Update CtsSettings'), 'icon'=>'edit', 'url' => array('/User/LoginCTS/ctsSettings/update', 'id' => $model->id)),
    array('label' => Yii::t('mess','Manage Cts Settings'), 'icon'=>'list', 'url' => array('/User/LoginCTS/ctsSettings/admin')),
    array('label' => Yii::t('mess','View Certificates'), 'icon'=>'eye', 'url' => array('/User/LoginCTS/ctsSettings/viewCertificates', 'id' => $model->id)),
);
?>
<div class="page-header">
    <h1><?= Yii::t('mess','View CtsSettings') .' #'?><?php echo $model->id; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'key',
        'certificate',
        'validate_response_key',
        'callback_url',
        'login_url',
        'logout_url',
        'asserationNS',
        'prefix',
        'issuer',
//            'key_path',
//                        'certificate_path' ,
//                        'v_responsekey_path',
        'is_default',
        'create_user_id',
        'create_datetime',
    ),
)); ?>
