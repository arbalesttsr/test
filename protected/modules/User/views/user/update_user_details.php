<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    $user_model->id => array('view', 'id' => $user_model->id),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('UserModule.t', 'MANAGE_USERS') => array("{$this->module->id}/User/admin"),
    Yii::t('mess', 'update'),
);

$this->menu = array(
//	array('label'=>'List User', 'url'=>array('index')),
    array('label' => Yii::t('UserModule.t', 'REGISTER_USER'), 'icon' => 'plus-circle', 'url' => array('register')),
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon' => 'list', 'url' => array('admin')),
    array('label' => Yii::t('UserModule.t', 'VIEW_USER'), 'icon' => 'eye', 'url' => array('userDetails', 'id' => $user_model->id)),
    array('label' => Yii::t('UserModule.t', 'ADD_FIELD'), 'icon' => 'plus', 'url' => array('/User/profile/fields', 'id' => $user_model->id)),
    array('label' => Yii::t('UserModule.t', 'CHANGE_PASSWORD'), 'icon' => 'refresh', 'url' => array('/User/password/change')),
    array('label' => Yii::t('UserModule.t', 'RESET_PASSWORD'), 'icon' => 'refresh', 'url' => array('passReset', 'id' => $user_model->id), 'visible' => Yii::app()->getUser()->isSa(),),
    array('label' => Yii::t('UserModule.t', 'RESET_SETTINGS'), 'icon' => 'wrench', 'url' => array('settingsReset', 'id' => $user_model->id), 'visible' => Yii::app()->getUser()->isSa(),),

);
?>
<!--<div class="page-header">-->
<h1><?php echo Yii::t('UserModule.t', 'UPDATE_USER') ?> #<?php echo $user_model->username; ?></h1>
<!--</div>-->
<div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4><i class="fa fa-edit icon-highlight icon-highlight-midnightblue"></i> <?= Yii::t('UserModule.t', 'UPDATE_USER') ?>
            #<?php echo $user_model->id; ?></h4>
        <div class="options">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#accountuser" data-toggle="tab"><i class="fa fa-desktop"></i> <?= Yii::t('mess','User Account') ?></a></li>
                <li class=""><a href="#profileuser" data-toggle="tab"><i class="fa fa-user"></i> <?= Yii::t('mess','User Profile') ?></a></li>

                <?php
                if (Yii::app()->getUser()->isSa()) {
                    echo '<li class=""><a href="#settinguser" data-toggle="tab"><i class="fa fa-wrench"></i> '.Yii::t('mess','User Settings').'</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane active" id="accountuser">
                <?php $this->renderPartial('update_user', array('model' => $user_model, 'roles' => $roles)); ?>
            </div>
            <div class="tab-pane" id="profileuser">
                <?php $this->renderPartial('/profile/update_profile', array('model' => $profile_model, 'additionalProfileModel' => $additionalProfileModel, 'fieldsConfig' => $fieldsConfig)); ?>
            </div>
            <?php
            if (Yii::app()->getUser()->isSa()) {
                ?>
                <div class="tab-pane" id="settinguser">
                    <?php
                    //$this->renderPartial('/userSettings/update_user_settings',array('model'=>$user_settings_model));
                    $this->renderPartial('/userSettings/_form_settings', array('model' => $user_settings_model));
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>