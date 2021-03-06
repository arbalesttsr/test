<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    $this->module->id => array("/{$this->module->id}/default/administration"),
    Yii::t('UserModule.t', 'BASE_INFO') => array('/User/profile/view', ['id' => $model->id]),
    Yii::t('UserModule.t', 'UPDATE_PROFILE')
);

Yii::app()->clientScript->registerScript('additionalProfile', "
$('.edit-add-fields').click(function(){
	$('#profile-additional-form,#profile-form').slideToggle();
        if($(this).hasClass('up_arrow')) $(this).removeClass('up_arrow').addClass('down_arrow');
        else $(this).removeClass('down_arrow').addClass('up_arrow');
	return false;
});
");

$this->menu = array(
//	array('label'=>'Listă Profile', 'url'=>array('index')),
    array('label' => Yii::t('UserModule.t', 'ADD_FIELD'), 'icon'=>'plus', 'url' => array('User/profile/fields'), 'visible' => Yii::app()->user->isSa()),
    array('label' => Yii::t('UserModule.t', 'VIEW_PROFILE'), 'icon'=>'eye', 'url' => array('User/profile/view', 'id' => $model->id)),
    array('label' => Yii::t('UserModule.t', 'MANAGE_PROFILES'), 'icon'=>'list', 'url' => array('User/profile/admin'), 'visible' => Yii::app()->user->isSa()),
    array('label' => Yii::t('UserModule.t', 'CHANGE_PASSWORD'), 'icon'=>'key', 'url' => array('User/password/change')),
);
?>


<?php //die(var_dump($additionalProfileModel))?>

    <!--div class="span8"-->
    <div class="page-header">
        <h1><?php echo Yii::t('UserModule.t', 'UPDATE_PROFILE') ?> </h1>
    </div>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'profile-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

        <?php echo Yii::t('mess', 'FIELDS_ARE_REQUIRED') ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'firstname'); ?>
            <?php echo $form->textField($model, 'firstname'); ?>
            <?php echo $form->error($model, 'firstname'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'lastname'); ?>
            <?php echo $form->textField($model, 'lastname'); ?>
            <?php echo $form->error($model, 'lastname'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'patronymic'); ?>
            <?php echo $form->textField($model, 'patronymic'); ?>
            <?php echo $form->error($model, 'patronymic'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'gender'); ?>
            <?php echo $form->dropDownList($model, 'gender', $model->getGenders(), array('prompt' => Yii::t('mess', 'select'))); ?>
            <?php echo $form->error($model, 'gender'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'idnp'); ?>
            <?php echo $form->textField($model, 'idnp', array('size' => 45, 'maxlength' => 13, 'placeholder' => Yii::t('UserModule.t', 'IDNP'))); ?>
            <?php echo $form->error($model, 'idnp'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'birthday'); ?>
            <?php echo $form->textField($model, 'birthday'); ?>
            <?php echo $form->error($model, 'birthday'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'about'); ?>
            <?php echo $form->textField($model, 'about'); ?>
            <?php echo $form->error($model, 'about'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'subsidiary_id'); ?>
            <?php echo $form->dropDownList($model, 'subsidiary_id', (isset(Yii::app()->modules['Clasificator'])) ? CHtml::listData(
                Subsidiary::model()->findAll(), 'id', 'name') : array('empty' => '---'), array('empty' => '---')); ?>
            <?php echo $form->error($model, 'subsidiary_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'department_id'); ?>
            <?php echo $form->dropDownList($model, 'department_id', (isset(Yii::app()->modules['Clasificator'])) ? CHtml::listData(
                Department::model()->findAll(), 'id', 'name') : array('empty' => '---'), array('empty' => '---')); ?>
            <?php echo $form->error($model, 'department_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone'); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'mobile'); ?>
            <?php echo $form->textField($model, 'mobile'); ?>
            <?php echo $form->error($model, 'mobile'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'avatar'); ?>
            <br><?php echo CHtml::activeFileField($model, 'avatar');//$form->fileField($model, 'avatar');?>
            <?php echo $form->error($model, 'avatar'); ?>

        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('mess', 'save')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

    <div class="page-header">
        <h4><?php echo Yii::t('UserModule.t', 'ADDITIONAL_FIELDS') ?></h4>
    </div>

<?php //echo CHtml::link('Edit additional Fields','#',array('class'=>'edit-add-fields')); ?>
<?php $this->widget('application.components.widgets.usertheme.UserButton', array(
    'label' => Yii::t('mess', 'edit'),
    'type' => 'success',
    'icon' => 'up_arrow',
    'url' => '#',
    'htmlOptions' => array('class' => 'edit-add-fields', 'style' => 'margin-bottom:10px')));
?>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'profile-additional-form',
            'htmlOptions' => array('style' => 'display:none'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )); ?>

        <?php echo $form->errorSummary($additionalProfileModel); ?>

        <?php
        foreach (Yii::app()->db->getSchema()->getTable(ProfileAdditional::model()->tableName())->columns as $column) {
            if ($column->name === 'id' or $column->name === 'user_id')
                continue;
            switch ($fieldsConfig[$column->name]['fieldType']) {
                case 'textField':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php echo $form->textField($additionalProfileModel, $column->name); ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                case 'textArea':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php echo $form->textArea($additionalProfileModel, $column->name, array('rows' => 6, 'cols' => 50)); ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                case 'dateField':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php echo $form->dateField($additionalProfileModel, $column->name); ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                case 'dropDownList':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php
                    if ($column->isForeignKey) {
                        //$requestedColumnName = ProfileAdditional::model()->getSecondColumn($column->name);
                        $requestedColumnName = $fieldsConfig[$column->name]['refColumn'];
                        $adition = $additionalProfileModel->attributeLabels();
                        $modelName = str_replace(' ', '', $adition[$column->name]);
                        $values = CHtml::listData(CActiveRecord::model($modelName)->findAll(), 'id', $requestedColumnName);
                        echo $form->dropDownList($additionalProfileModel, $column->name, $values, array('prompt' => Yii::t('label', 'SELECT')));
                    } else {
                        $att_enum = ProfileAdditional::model()->getEnumValues();
                        echo $form->dropDownList($additionalProfileModel, $column->name, $att_enum[$column->name]);
                    }
                    ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                case 'numberField':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php echo $form->numberField($additionalProfileModel, $column->name, array('step' => 'any')); ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                case 'checkBox':
                    ?>
                    <div class="row">
                    <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                    <?php echo $form->checkBox($additionalProfileModel, $column->name); ?>
                    <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div><?php
                    break;
                default:
                    ?>
                    <div class="row">
                        <?php echo $form->labelEx($additionalProfileModel, $column->name); ?>
                        <?php echo $form->textField($additionalProfileModel, $column->name); ?>
                        <?php echo $form->error($additionalProfileModel, $column->name); ?>
                    </div>
                    <?php
            }
        }
        ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton(Yii::t('mess', 'save')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
<?php Yii::app()->clientScript->registerScript('datapicker-profile-update', '
    $("#Profile_birthday").datepicker({
        //changeYear: true,
        maxDate: ((new Date()).getFullYear() - 18) + "-" + (new Date()).getMonth() + "-" + (new Date()).getDate(),
        dateFormat: "yy-mm-dd",
        showAnim: "drop"
    });
', CClientScript::POS_READY); ?>