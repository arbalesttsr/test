<?php
/* @var $this LdapSettingsController */
/* @var $model LdapSettings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ldap-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?= Yii::t('mess','The fields with') ?> <span class="required">*</span> <?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'synapsis_user'); ?>
        <?php
        // echo $form->dropDownList($model,'synapsis_user', $list,array('placeholder'=>Yii::t('UserModule.t', 'Synapsis Users'),'empty'=>'---'));
        ?>
        <?php
        $this->widget('ext.select2.ESelect2', array(
            'model' => $model,
            'attribute' => 'synapsis_user',
            'data' => User::GetUsersList(),
            'options' => array(
                'placeholder' => Yii::t('mess','Select user'),
                'allowClear' => true,
            ),
        ));
        ?>
        <?php echo $form->error($model, 'synapsis_user'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_username'); ?>
        <?php echo $form->textField($model, 'ldap_username', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'ldap_username'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_host'); ?>
        <?php echo $form->textField($model, 'ldap_host', array('size' => 60, 'maxlength' => 150)); ?>
        <?php echo $form->error($model, 'ldap_host'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_port'); ?>
        <?php echo $form->textField($model, 'ldap_port', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'ldap_port'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_dc'); ?>
        <?php echo $form->textField($model, 'ldap_dc', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'ldap_dc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_ou'); ?>
        <?php echo $form->textField($model, 'ldap_ou', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'ldap_ou'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    getFunctionar();
    $("#LdapSettings_synapsis_user").bind('change select keypress', function () {
        getFunctionar()
    });
    function getFunctionar() {
        $.ajax(
            {
                type: "post",
                url: "<?php echo CController::createUrl('/User/LoginAD/ldapSettings/getLdapUsername'); ?>",
                data: {name: $('#LdapSettings_synapsis_user').val()},
                success: function (id) {
                    var LdapSettings = id;
                    $('#LdapSettings_ldap_username').val(id);
                    //$('#BirthCertificates_office_issue_id').val(arr[1]);
                }
            }
        );
    }
</script>