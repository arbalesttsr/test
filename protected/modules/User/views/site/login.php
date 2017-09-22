<?php
/* @var $this LoginController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('mess', 'LOGIN');
/*$this->breadcrumbs=array(
	'login',
);*/

Yii::app()->clientScript->registerScript('add', "

$('select#LoginForm_loginMethod').change(function(){
	$('input#LoginForm_loginMethod').val($(this).val());
	$('#LoginForm_loginMethod').each(function(){
		$('#privatekey-field,#cts-form-container').hide();
		$('#login-form-inputs').show();
		if ($(this).val()==3) {
			$('#privatekey-field').show();
		}
		if ($(this).val()==4) {
			$('#login-form-inputs').hide();
			$('#cts-form-container').show();
		}
	});
});

");

?>

    <div class="verticalcenter form-login-content">
        <a href="<?=Yii::app()->createUrl('/site/index');?>"><img src="<?=Yii::app()->theme->baseUrl;?>/assets/img/logo-big.png" alt="Synapsis" class="brand" /></a>
        <div class="row"><div class="col-md-12">
                <?php /* ?>
                    <div class="pull-left">
                        <a href="?_run_as=<?=strtolower(AP_YII_NUMODULE)?>" class="btn btn-info btn-sm btn-label pull-right"><i class="fa fa-user<?=(AP_YII_UMODULE=='Client'?'-secret':'')?>"></i> <?=Yii::t('UserModule.t', 'Login as');?> <?=Yii::t('UserModule.t', AP_YII_NUMODULE)?></a>
                        <a href="?_run_as=user" class="btn btn-info btn-sm pull-right<?=(AP_YII_UMODULE=='User'?' active':'')?>"><?=Yii::t('UserModule.t', 'Login as');?> <?=Yii::t('UserModule.t', 'User')?></a>
                        <a href="?_run_as=client" class="btn btn-info btn-sm pull-right<?=(AP_YII_UMODULE=='Client'?' active':'')?>"><?=Yii::t('UserModule.t', 'Login as');?> <?=Yii::t('UserModule.t', 'Client')?></a>
                    </div>
                <?php */ ?>
                <div class="pull-right">
                    <?php $this->widget('application.components.widgets.usertheme.LoginLanguageWidget'); ?>
                </div>
            </div></div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="text-center alert alert-success" style="margin-bottom: 25px; color: #2973cf;"><i class="fa fa-user<?=(AP_YII_UMODULE=='User'?'-secret':'')?>" style="margin: 10px; font-size: 20px;"></i><?=Yii::t('UserModule.t', 'AUTHENTICATION_'.strtoupper(AP_YII_UMODULE))?></h4>
                <?php $formLoginType=$this->beginWidget('CActiveForm', array( //form login intern
                    'id'=>'login-form-type-login',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                    'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
                )); ?>

                <?php if(/*AP_YII_UMODULE!='User' && */is_null($model->loginMethod)){ $model->loginMethod = 1; }
                /*elseif(is_null($model->loginMethod)) { $model->loginMethod = 1; };*/?>
                <div class="form-group">
                    <div class="col-sm-12">
                        <?php echo $formLoginType->labelEx($model,'loginMethod');
                        echo $formLoginType->dropDownList($model,'loginMethod',$model->getLoginMethods2(),array('class'=>'form-control'));
                        echo $formLoginType->error($model,'loginMethod'); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
                <div id="login-form-inputs" style="display: <?=(in_array($model->loginMethod,array(1,null))?'block':'none')?>"><!-- div cu elementele de logare locale -->
                    <?php $form=$this->beginWidget('CActiveForm', array( //form login intern
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                        'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-horizontal'),
                    )); ?>
                    <?php echo $form->hiddenField($model,'loginMethod'); ?>
                    <?php $penalization_minutes = isset($_POST['LoginForm']['username']) ? User::getUserPenalization($_POST['LoginForm']['username']) : 0;
                    if(!$penalization_minutes) { ?>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user<?=(AP_YII_UMODULE=='User'?'-secret':'')?>"></i></span>
                                    <?php echo $form->textField($model,'username',array('placeholder'=>Yii::t('UserModule.t','USERNAME'), 'class'=>'form-control tooltips', 'data-trigger'=>'hover', 'data-original-title'=>'Tooltip text goes here. Tooltip text goes here.')); ?>
                                </div>
                                <?php echo $form->error($model,'username',array('class'=>'text-danger')); ?>
                            </div>
                        </div>

                        <div class="form-group"  id="privatekey-field" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                    <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-bottom: 0;">
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new"><?= Yii::t('mess','Select file') ?></span>
                                            <span class="fileinput-exists"><?= Yii::t('mess','Change') ?></span>
                                            <?php echo CHtml::activefileField($model,'privateKeyFile'); ?>
                                        </span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                    </div>
                                </div>
                                <?php echo $form->error($model,'privateKeyFile'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <?php echo $form->passwordField($model,'password',array('placeholder'=>Yii::t('UserModule.t','PASSWORD'), 'class'=>'form-control')); ?>
                                </div>
                                <?php echo $form->error($model,'password',array('class'=>'text-danger')); ?>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="pull-right">
                                <?php echo $form->checkBox($model,'rememberMe'); ?>
                                <?php echo $form->label($model,'rememberMe'); ?>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <?php echo CHtml::link(Yii::t('mess','Forgot your password?'), array('/User/site/recoveryPassword'), array('class'=>'pull-left btn btn-link', 'style'=>'padding-left:0'));?>
                            <div class="pull-right">
                                <?php echo CHtml::button(Yii::t('mess','RESET'),array('class'=>'btn btn-default', 'type'=>'reset')); ?>
                                <?php echo CHtml::submitButton(Yii::t('mess','LOGIN'),array('class'=>'btn btn-primary')); ?>
                            </div>
                        </div>

                        <?php if(AP_YII_UMODULE=='Client') { ?>
                            <br><br>
                            <a class="btn btn-success" href="/Registration/index" role="button" style="width: 100%"><?= YII::t('mess','REGISTRATION') ?></a>
                        <?php } ?>

                    <?php } else {
                        echo '<div class="alert alert-dismissable alert-danger">'. Yii::t('mess','pass') .' '.$penalization_minutes.' '. Yii::t('mess','minute') .'</div>';
                    } ?>
                    <?php $this->endWidget(); ?>
                </div>


                <div class="" style="display: <?=($model->loginMethod==4?'block':'none')?>" id="cts-form-container">
                    <?php $form=$this->beginWidget('CActiveForm', array( //forma CTS
                        'id'=>'cts-form',
                        'action' => $cts->getLoginUrl(),
                        'htmlOptions'=>array('class'=>'')
                    )); ?>
                    <?php echo CHtml::hiddenField('SAMLRequest',$cts->getRequestData(true));?>
                    <?php echo CHtml::hiddenField('RelayState',$cts->getID());?>

                    <div class="panel-footer">
                        <?php echo CHtml::submitButton(Yii::t('mess','AUTHENTICATE'),array('class'=>'btn btn-large btn-primary pull-right')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>
            <!--div class="pull-left">
                <a href="?_run_as=<?=strtolower(AP_YII_NUMODULE)?>"><i class="fa fa-user<?=(AP_YII_UMODULE=='Client'?'-secret':'')?>"></i> <?=Yii::t('UserModule.t', 'Login as');?> <?=Yii::t('UserModule.t', AP_YII_NUMODULE)?></a>
            </div-->
        </div>
    </div>