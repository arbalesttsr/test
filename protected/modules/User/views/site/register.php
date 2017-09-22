<div class="verticalcenter form-login-content">
    <span><img src="<?= Yii::app()->theme->baseUrl; ?>/assets/img/logo-big.png" alt="Logo" class="brand"/></span>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'register-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => "form-horizontal row-border"),

            )); ?>
            <!--div class="panel-heading">
                <h4>Va rugam sa completati datele dvs. personale</h4>
                <div class="options">

                </div>
            </div-->
            <div class="panel-body" style="border-radius: 0px;">
                <div class="row">
                    <div class="col-md-12">
                        <?php /*if(isset($_POST['Profile']) && !$model->validate()) { ?>
                            <div class="alert alert-danger">
                                <?php echo $form->errorSummary($model); ?>

                            </div>
                        <?php } else*/
                        if (isset($success_messages) && is_array($success_messages) && !empty($success_messages)) { ?>
                            <div class="alert alert-info">
                                <?php foreach ($success_messages as $success_message) { ?>
                                    <ul>
                                        <li><?php echo $success_message; ?></li>
                                    </ul>
                                <?php } ?>
                            </div>
                        <?php } elseif (isset($error_messages) && is_array($error_messages) && !empty($error_messages)) { ?>
                            <div class="alert alert-danger">
                                <?php foreach ($error_messages as $error_message) { ?>
                                    <ul>
                                        <li><?php echo $error_message; ?></li>
                                    </ul>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label
                                class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('firstname'); ?></label>
                            <div class="col-sm-9">
                                <?php echo $form->textField($model, 'firstname', array('size' => 150, 'maxlength' => 150, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('firstname'))); ?>
                                <?php echo $form->error($model, 'firstname', array('class' => 'alert alert-danger', 'style' => 'padding: 2px 5px; margin-bottom: 0;')); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('lastname'); ?></label>
                            <div class="col-sm-9">
                                <?php echo $form->textField($model, 'lastname', array('size' => 150, 'maxlength' => 150, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('lastname'))); ?>
                                <?php echo $form->error($model, 'lastname', array('class' => 'alert alert-danger', 'style' => 'padding: 2px 5px; margin-bottom: 0;')); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('idnp'); ?></label>
                            <div class="col-sm-9">
                                <?php echo $form->textField($model, 'idnp', array('size' => 13, 'maxlength' => 13, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('idnp'))); ?>
                                <?php echo $form->error($model, 'idnp', array('class' => 'alert alert-danger', 'style' => 'padding: 2px 5px; margin-bottom: 0;')); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('email'); ?></label>
                            <div class="col-sm-9">
                                <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email'))); ?>
                                <?php echo $form->error($model, 'email', array('class' => 'alert alert-danger', 'style' => 'padding: 2px 5px; margin-bottom: 0;')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="btn-toolbar">
                            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Logare', array('/User/site/login'), array('class' => 'btn btn-default pull-left')); ?>
                            <?php echo CHtml::submitButton(Yii::t('mess','REGISTRATION'), array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>