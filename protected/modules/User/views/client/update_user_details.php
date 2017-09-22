<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    $user_model->id => array('view', 'id' => $user_model->id),
    'Clients Management' => array("{$this->module->id}/Client/admin"),
    'Update',
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon' => 'list', 'url' => array('/User/client/admin')),
    array('label' => Yii::t('UserModule.t', 'RESET_PASSWORD'), 'icon' => 'refresh', 'url' => array('/User/client/passReset', 'id' => $user_model->id),),

);
?>
<!--<div class="page-header">-->
<h1><?php echo Yii::t('UserModule.t', 'UPDATE_USER') ?> #<?php echo $user_model->username; ?></h1>
<!--</div>-->
<div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4><i class="fa fa-edit icon-highlight icon-highlight-midnightblue"></i> Update Client
            #<?php echo $user_model->id; ?></h4>
        <div class="options">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#accountuser" data-toggle="tab"><i class="fa fa-desktop"></i> User
                        Account</a></li>
                <li class=""><a href="#profileuser" data-toggle="tab"><i class="fa fa-user"></i> User Profile</a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane active" id="accountuser">
                <?php $this->renderPartial('update_user', array('model' => $user_model)); ?>
            </div>
            <div class="tab-pane" id="profileuser">
                <?php $this->renderPartial('/clientProfile/update_profile', array('model' => $profile_model, 'additionalProfileModel' => $additionalProfileModel, 'fieldsConfig' => $fieldsConfig)); ?>
            </div>
        </div>
    </div>
</div>