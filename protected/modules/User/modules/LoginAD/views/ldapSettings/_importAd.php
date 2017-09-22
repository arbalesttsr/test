<?php


$this->pageTitle = Yii::app()->name . ' - Import Users AD';
//$this->menu=array(
//    //array('label' => Yii::t('UserModule.user','Register'), 'url'=>array('/User/user/register')),
//    array('label' => Yii::t('UserModule.t','MANAGE_USERS'), 'icon'=>'list','url'=>array('/User/user/admin'), 'visible'=>Yii::app()->user->isSa()),
//    array('label' => Yii::t('UserModule.t','PROFILES'), 'icon'=>'user','url'=>array('/User/profile/index'), 'visible'=>Yii::app()->user->isSa()),
//    //array('label' => Yii::t('UserModule.user','Fields'), 'url'=>array('/User/profile/fields')),
//    //array('label' => Yii::t('UserModule.user','Certificates'), 'url'=>array('/User/certificate/create')),
//);

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
    Yii::t('mess', 'IMPORT_USERS_AD'),
);
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4><?= Yii::t('mess', 'IMPORT_USERS_AD') ?></h4>
    </div>
    <div class="panel-body">
        <p><?= Yii::t('mess', 'import message 1') ?></p>
        <legend><?= Yii::t('mess', 'import message 2') ?></legend>
        <?php
        if (!empty($message)) {
            ?>
            <div class="alert alert-dismissable alert-danger">
                <strong>Oppsss!</strong> <?php echo $message; ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>

            <?php
        }
        ?>
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'importUserAd-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); ?>

            <?php //echo Yii::t('base', 'FIELDS_ARE_REQUIRED')?>


            <div class="row">
                <?php echo $form->labelEx($model, 'userAd'); ?>
                <?php echo $form->textField($model, 'userAd', array()); ?>
                <?php echo $form->error($model, 'userAd'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'passwordAd'); ?>
                <?php echo $form->passwordField($model, 'passwordAd', array()); ?>
                <?php echo $form->error($model, 'passwordAd'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'ldap_setting'); ?>
                <?php echo $form->dropDownList($model, 'ldap_setting', LdapSettings::GetLdapSettingsList(), array('prompt' => Yii::t('mess', 'SELECT_LDAP_SETTING'))); ?>
                <?php echo $form->error($model, 'ldap_setting'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'role'); ?>
                <?php echo $form->dropDownList($model, 'role', $roles, array('placeholder' => Yii::t('UserModule.t', 'Role'), 'empty' => yii::t('mess','choose_role'))); ?>
                <?php echo $form->error($model, 'role'); ?>
            </div>

            <div class=" pull-right">
                <?php echo CHtml::submitButton(Yii::t('mess', 'GET LDAP USERS'), array('class' => 'btn btn-primary')); ?>
            </div>


            <?php $this->endWidget(); ?>
        </div><!-- form -->

    </div>
</div>