<div class="verticalcenter form-login-content">
    <span><img src="<?= Yii::app()->theme->baseUrl; ?>/assets/img/logo-big.png" alt="Logo" class="brand"/></span>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center"
                style="margin-bottom: 25px;"><?= Yii::t('mess', 'Va rugam sa completati datele dvs. personale') ?></h4>
            <?php $show_form = true; ?>
            <?php foreach ($messages as $message) { ?>
                <?php if ($message['type'] == 'info') $show_form = false; ?>
                <div class="alert alert-<?= $message['type']; ?>">
                    <?= $message['msg']; ?>
                </div>
            <?php } ?>
            <?php if ($show_form) { ?>
                <div class="alert alert-warning">
                    <strong><?= Yii::t('mess', 'Aveti deja un cont in sistem?') ?></strong>
                    <br/><?= Yii::t('mess', 'Completati IDNP-ul si email-ul pentru a primi parola noua') ?>
                </div>
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'register-profile-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal'),
                )); ?>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?php //echo $form->textField($model,'idnp',array('size'=>13,'maxlength'=>13, 'class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('idnp'))); ?>
                            <?php echo $form->textField($model, 'idnp', array('size' => 13, 'maxlength' => 13, 'placeholder' => $model->getAttributeLabel('idnp'), 'class' => 'form-control')); ?>
                        </div>
                        <?php echo $form->error($model, 'idnp', array('class' => 'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <?php //echo $form->textField($model,'idnp',array('size'=>13,'maxlength'=>13, 'class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('idnp'))); ?>
                            <?php echo $form->textField($model, 'email', array('placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control')); ?>
                        </div>
                        <?php echo $form->error($model, 'email', array('class' => 'text-danger')); ?>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="pull-left">
                        <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> '.Yii::t('mess','Logare').'', array('/User/site/login'), array('class' => 'btn btn-default')); ?>
                        <?php //echo CHtml::button('<i class="fa fa-arrow-left"></i>' . Yii::t('label','RESET'),array('class'=>'btn btn-default', 'type'=>'reset')); ?>
                    </div>
                    <div class="pull-right">
                        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('mess','Recuperati Parola') : Yii::t('mess','Actualizati Parola'), array('class' => 'btn btn-primary')); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            <?php } ?>
        </div>
    </div>
</div>


<?php /* old design

<div class="page-header">
    <h1>Va rugam sa completati datele dvs. personale</h1>
</div>

<div class="well">
    <?php $show_form = true; ?>
    <?php foreach($messages as $message) { ?> 
        <?php if($message['type']=='info') $show_form = false;  ?> 
        <div class="alert alert-<?=$message['type'];?>">
            <?=$message['msg'];?>
        </div>
    <?php } ?>
    <?php if($show_form){ ?>
    <div class="alert alert-warning">
        <strong>Aveti deja un cont in sistem?</strong>
        <br/>Completati IDNP-ul si email-ul pentru a primi parola noua
    </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'register-profile-form',
            'enableAjaxValidation'=>false,
    )); ?>
    <?php //echo $form->errorSummary($model); ?>
            <fieldset>
                <div class="widget widget-4">
                    <div class="widget-head"><h4 class="heading"><?php echo $model->getAttributeLabel('idnp'); ?></h4></div>
                    <div class="separator"></div>
                    <div class="row-fluid">
                        <?php echo $form->textField($model,'idnp',array('size'=>13,'maxlength'=>13, 'class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('idnp'))); ?>
                        <?php echo $form->error($model,'idnp',array('class'=>'alert alert-error', 'style'=>'padding: 2px 5px;')); ?>
                    </div>
                </div>
            </fieldset>
            <hr class="separator top">
            <fieldset>
                <div class="widget widget-4">
                    <div class="widget-head"><h4 class="heading"><?php echo $model->getAttributeLabel('email'); ?></h4></div>
                    <div class="separator"></div>
                    <div class="row-fluid">
                        <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50, 'class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('email'))); ?>
                        <?php echo $form->error($model,'email',array('class'=>'alert alert-error', 'style'=>'padding: 2px 5px;')); ?>
                    </div>
                </div>
            </fieldset>
            <hr class="separator top">

            <hr class="separator bottom">
            <div class="buttons pull-right" style="margin-top: 0;">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Recuperati' : 'Actualizati', array('class'=>'btn btn-primary')); ?>
            </div>
            <div style="clear: both"></div>
    <?php $this->endWidget(); ?>
    <?php } ?>
</div>

<?php Yii::app()->clientScript->registerCss('registerClientCss','
    .widget-head {
        background-color: #fff!important;
    }

    .widget-head h4.heading{
        font-size: 13px; 
        padding-left: 5px;
    }
'); ?>


<?php //Yii::app()->clientScript->scriptMap['jquery.js']=false;?>
<?php //Yii::app()->clientScript->scriptMap['jquery-ui.min.js']=false;?>
<?php Yii::app()->clientScript->registerScript('bookingOneScript','
    if ($("input.date_of_birth").length) 
    {
        $("input.date_of_birth").datepicker({
            showOtherMonths:true,
            dateFormat:"yy-mm-dd",
            maxDate:new Date('.date("Y,n,j", strtotime("-18 years", time())).')
        });
    }',CClientScript::POS_END); */ ?>