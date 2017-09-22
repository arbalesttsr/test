<?php

?>

<div class="progress">
    1→<span class="active">2</span>→3
</div>

<h1><?php echo Yii::t('InstallModule.menu', 'Pasul 2. Crearea Bazei de Date.') ?></h1>

<div class="line"></div>

<div class="form wide">
    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->label($model, 'yiiPath'); ?>
        <?php echo $form->textField($model, 'yiiPath') ?>
        <span class="required"> *</span>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'dbType'); ?>
        <?php echo $form->dropDownList($model, 'dbType', array('mysql' => 'MySQL', 'pgsql' => 'PostgreSql', 'mssql' => 'MSSQL')); ?>
        <span class="required"> *</span>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'port'); ?>
        <?php echo $form->textField($model, 'port') ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'dbHost'); ?>
        <?php echo $form->textField($model, 'dbHost') ?>
        <span class="required"> *</span>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'dbName'); ?>
        <?php echo $form->textField($model, 'dbName') ?>
        <span class="required"> *</span>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'dbUserName'); ?>
        <?php echo $form->textField($model, 'dbUserName') ?>
        <span class="required"> *</span>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'dbPassword'); ?>
        <?php echo $form->passwordField($model, 'dbPassword') ?>
    </div>

    <div class="row buttons">
        <label
            style="width:300px;"><?php echo $form->checkBox($model, Yii::t('InstallModule.menu', 'restoreData')) ?><?php echo $model->getAttributeLabel('restoreData') ?></label>
    </div>

    <div class="row buttons">
        <input type="submit" value="<?php echo Yii::t('InstallModule.core', 'Creare DB') ?>"
               onclick="this.disabled=true;this.value='Creare...';this.form.submit();">
    </div>

    <?php $this->endWidget(); ?>

    <?php
    if ($msg)
        echo $msg;
    if ($flag) {
        ?>
        <h2>Stergere date</h2>
        <?php $form = $this->beginWidget('CActiveForm'); ?>
        <div class="row">
            <?php echo $form->radioButtonList($model, 'deleteData', array('da' => 'da', 'nu' => 'nu')); ?>
            <?php echo CHtml::activeHiddenField($model, 'dbHost', array('value' => $model->dbHost)); ?>
            <?php echo CHtml::activeHiddenField($model, 'dbName', array('value' => $model->dbName)); ?>
            <?php echo CHtml::activeHiddenField($model, 'dbUserName', array('value' => $model->dbUserName)); ?>
            <?php echo CHtml::activeHiddenField($model, 'dbPassword', array('value' => $model->dbPassword)); ?>
        </div>
        <div class="row buttons">
            <input type="submit" value="<?php echo Yii::t('InstallModule.core', 'Executa') ?>"
                   onclick="this.disabled=true;this.value='Stergere...';this.form.submit();">
        </div>
        <?php $this->endWidget(); ?>
    <?php } ?>
</div>



















