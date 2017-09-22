<?php if (Yii::app()->user->hasFlash('success')) { ?>
    <div class="alert alert-info">
        <?=Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php $cs = Yii::app()->getClientScript();

    $cs->registerCss('additional-css-last',
        '
    .hero {
    padding-top: 20%;
    height: 100%!important;
    } '); ?>
<?php } else { ?>

    <?php if (Yii::app()->user->isGuest || Yii::app()->user->checkAccess('Registration:Index')) { ?>
    <br>
    <br>
    <br>
        <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.6); padding-top: 5%; padding-bottom: 5%;">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'hb-form',
                        'enableAjaxValidation' => false,
                    )); ?>
                    <?= $form->errorSummary($user, null, null, [
                        'class' => 'alert alert-danger'
                    ]); ?>
                    <div class="form-group">
                        <?= $form->labelEx($user, 'idnp'); ?>
                        <?= $form->textField($user, 'idnp', array("class" => "form-control", 'size' => 60, 'maxlength' => 13)); ?>

                        <?= $form->error($user, 'idnp'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($profile, 'firstname'); ?>
                        <?php echo $form->textField($profile, 'firstname', array("class" => "form-control", 'size' => 60, 'maxlength' => 255)); ?>

                        <?= $form->error($user, 'firstname'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($profile, 'lastname'); ?>
                        <?php echo $form->textField($profile, 'lastname', array("class" => "form-control", 'size' => 60, 'maxlength' => 255)); ?>

                        <?= $form->error($user, 'lastname'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($profile, 'mobile'); ?>
                        <?php echo $form->textField($profile, 'mobile', array("class" => "form-control", 'size' => 60, 'maxlength' => 255, 'value' => '+373')); ?>

                        <?= $form->error($user, 'mobile'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($profile, 'email'); ?>
                        <?php echo $form->textField($profile, 'email', array("class" => "form-control", 'size' => 60, 'maxlength' => 255)); ?>

                        <?= $form->error($user, 'email'); ?>
                    </div>
                    <?php if (Yii::app()->getModule('User')->tablePrefix == 'cli') { ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($user, 'username'); ?>
                            <?php echo $form->textField($user, 'username', array("class" => "form-control", 'size' => 45, 'maxlength' => 100, 'placeholder' => Yii::t('UserModule.t', 'USERNAME'))); ?>

                            <?= $form->error($user, 'username'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($user, 'password'); ?>
                            <?php echo $form->passwordField($user, 'password', array("class" => "form-control", 'size' => 45, 'maxlength' => 10, 'placeholder' => Yii::t('UserModule.t', 'PASSWORD'))); ?>

                            <?= $form->error($user, 'password'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($user, 'passwordCompare'); ?>
                            <?php echo $form->passwordField($user, 'passwordCompare', array("class" => "form-control", 'size' => 45, 'maxlength' => 10, 'placeholder' => Yii::t('UserModule.t', 'REPEAT_PASSWORD'))); ?>

                            <?= $form->error($user, 'passwordCompare'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($user, 'recaptcha'); ?>
                            <div class="row">
                                <div class="col-md-7">
                                    <?php echo $form->textField($user, 'recaptcha', array(
                                        "class" => "form-control",
                                        'size' => 45,
                                        'maxlength' => 100,
                                        'placeholder' => Yii::t('UserModule.t', 'RECAPTCHA'),
                                    )); ?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->widget('CCaptcha'); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group hb-checkbox">
                        <?php echo $form->checkBox($user, 'confirmation', array(
                            "class" => "form-control",
                            'placeholder' => Yii::t('UserModule.t', 'confirmation'),
                        )); ?>
                        <?php echo $form->labelEx($user, 'confirmation', [
                            'class' => 'no-special-required'
                        ]); ?>
                    </div>
                    <div class="form-group hb-checkbox">
                        <?php echo $form->checkBox($user, 'regle', array(
                            "class" => "form-control",
                            'placeholder' => Yii::t('UserModule.t', 'regle'),
                        )); ?>
                        <?= CHtml::link('<span for="accord" class="l" style="color: #ffffff;"><b>' . Yii::t('UserModule.t', 'regle') . '</b></span>', ' ', array('id' => 'reglament')); ?>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-success btn-block hb-btn-success" onclick="setAfterReg()">Submit</button>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <!--            <div class="alert alert-info">-->
        <!--                --><?php //echo "sunteti logat" ?>
        <!--            </div>-->
    <?php } ?>
<?php } ?>


<script>
    localStorage.setItem("after_reg", false);
    function setAfterReg() {
        localStorage.setItem("after_reg", true);
    }
</script>
