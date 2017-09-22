<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note"><?php echo Yii::t('mess', 'FIELDS_ARE_REQUIRED') ?></p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'role'); ?>
        <?php echo $form->dropDownList($model, 'role', $roles, array('placeholder' => Yii::t('UserModule.t', 'Role'), 'empty' => '---')); ?>
        <?php echo $form->error($model, 'role'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 45, 'maxlength' => 45, 'placeholder' => Yii::t('UserModule.t', 'USERNAME'))); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ad_username'); ?>
        <?php echo $form->textField($model, 'ad_username', array('size' => 45, 'maxlength' => 45, 'placeholder' => Yii::t('UserModule.t', 'AD_USERNAME'))); ?>
        <?php echo $form->error($model, 'ad_username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'idnp'); ?>
        <?php echo $form->textField($model, 'idnp', array('size' => 45, 'maxlength' => 13, 'placeholder' => Yii::t('UserModule.t', 'IDNP'))); ?>
        <?php echo $form->error($model, 'idnp'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'status_id'); ?>
        <?php echo $form->dropDownList($model, 'status_id', $model->getUserStatus(), array('prompt' => Yii::t('label', 'SELECT'))); ?>
        <?php echo $form->error($model, 'status_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'sql_user'); ?>
        <?php echo $form->checkBox($model, 'sql_user'); ?>
        <?php echo $form->error($model, 'sql_user'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('mess', 'save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<!--/div-->