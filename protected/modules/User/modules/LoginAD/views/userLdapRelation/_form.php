<?php
/* @var $this UserLdapRelationController */
/* @var $model UserLdapRelation */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-ldap-relation-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?= Yii::t('mess','Fields with') ?> <span class="required">*</span><?= Yii::t('mess','are required') ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php
        //echo $form->textField($model,'user_id',array('size'=>20,'maxlength'=>20));
        ?>
        <?php
        $this->widget('ext.select2.ESelect2', array(
            'model' => $model,
            'attribute' => 'user_id',
            'data' => User::GetUsersList(),
            'options' => array(
                'placeholder' => Yii::t('mess','Select user'),
                'allowClear' => true,
            ),
        ));
        ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_user'); ?>
        <?php echo $form->textField($model, 'ldap_user', array('size' => 20, 'maxlength' => 20, 'value' => !is_null($ldap_id) ? $ldap_id : 0)); ?>
        <?php echo $form->error($model, 'ldap_user'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'ldap_setting_id'); ?>
        <?php echo $form->dropDownList($model, 'ldap_setting_id', LdapSettings::GetLdapSettingsList(), array('prompt' => Yii::t('mess', 'SELECT_LDAP_SETTING'))); ?>
        <?php echo $form->error($model, 'ldap_setting_id'); ?>
    </div>
    <!--	<div class="row">
		<?php echo $form->labelEx($model, 'ldap_setting_id'); ?>
		<?php echo $form->textField($model, 'ldap_setting_id', array('size' => 20, 'maxlength' => 20, 'value' => !is_null($ldap_id) ? $ldap_id : 0)); ?>
		<?php echo $form->error($model, 'ldap_setting_id'); ?>
	</div>-->

    <!--	<div class="row">
		<?php echo $form->labelEx($model, 'create_user_id'); ?>
		<?php echo $form->textField($model, 'create_user_id', array('size' => 20, 'maxlength' => 20)); ?>
		<?php echo $form->error($model, 'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'create_datetime'); ?>
		<?php echo $form->textField($model, 'create_datetime'); ?>
		<?php echo $form->error($model, 'create_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'update_user_id'); ?>
		<?php echo $form->textField($model, 'update_user_id', array('size' => 20, 'maxlength' => 20)); ?>
		<?php echo $form->error($model, 'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'update_datetime'); ?>
		<?php echo $form->textField($model, 'update_datetime'); ?>
		<?php echo $form->error($model, 'update_datetime'); ?>
	</div>-->

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','create') : Yii::t('mess','save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    getFunctionar();
    $("#UserLdapRelation_user_id").bind('change select keypress', function () {
        getFunctionar()
    });
    function getFunctionar() {
        $.ajax(
            {
                type: "post",
                url: "<?php echo CController::createUrl('/User/LoginAD/ldapSettings/getLdapUsername'); ?>",
                data: {name: $('#UserLdapRelation_user_id').val()},
                success: function (id) {
                    var LdapSettings = id;
                    $('#UserLdapRelation_ldap_user').val(id);
                    //$('#BirthCertificates_office_issue_id').val(arr[1]);
                }
            }
        );
    }
</script>