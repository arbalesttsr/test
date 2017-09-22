<?php $form=$this->beginWidget('CActiveForm', array( //form login intern
    'id'=>'ajax-login-form',
    'action' => Yii::app()->createUrl('User/site/loginAjax'),
    'method' => 'post',
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'navbar-form navbar-right'),
)); ?>
    <div class="row">
        <?php $model->loginMethod = LoginForm::DataBase_Login;
        echo $form->hiddenField($model, 'loginMethod'); ?>
        <div class="form-group col-xs-4 col-sm-2 text-right login-run-as">
            <?php if(count($loginAs) > 1) {
                $checked = (AP_YII_UMODULE == 'Client');
                echo '<input '.($checked?' checked="checked"':'').'data-size="small" data-toggle="toggle" data-on="'.Yii::t('mess', "I'm Client").'" data-off="'.Yii::t('mess', "I'm Employee").'" data-onstyle="info" data-offstyle="primary" name="'.CHtml::activeName($model,'runAs').'" id="'.CHtml::activeId($model,'runAs').'" value="'.($checked?'1' : "0").'" type="checkbox">';//$form->checkBox($model,'runAs',  array('checked'=>"checked", 'data-size'=>"small", 'data-toggle'=>"toggle", 'data-on'=>"I'm Client", 'data-off'=>"I'm Notar", 'data-onstyle'=>"info", 'data-offstyle'=>"primary"));
            } elseif(in_array(LoginForm::RUN_AS_USER, $loginAs)) {
                $model->runAs = LoginForm::RUN_AS_USER;
                echo $form->hiddenField($model, 'runAs');
            } else {
                $model->runAs = LoginForm::RUN_AS_CLIENT;
                echo $form->hiddenField($model, 'runAs');
            }
            ?>
        </div>
        <div class="form-group col-xs-4 col-sm-3">
            <!--input type="text" placeholder="Email" class="form-control"-->
            <?php echo $form->textField($model,'username',array('placeholder'=>Yii::t('UserModule.t','USERNAME'), 'class'=>'form-control')); ?>
        </div>
        <div class="form-group col-xs-4 col-sm-3">
            <!--input type="password" placeholder="Password" class="form-control"-->
            <?php echo $form->passwordField($model,'password',array('placeholder'=>Yii::t('UserModule.t','PASSWORD'), 'class'=>'form-control')); ?>
        </div>
        <div class="form-group col-xs-12 col-sm-4 text-right">
            <button type="submit" class="btn btn-success"><?=Yii::t('mess', 'Sign in')?></button>
            <a href="<?= Yii::app()->createUrl('/Registration/index') ?>" class="btn btn-primary register-link"<?= AP_YII_UMODULE == 'User' ? ' disabled="disabled"':'' ?>><?=Yii::t('mess', 'Register Client')?></a>
        </div>
    </div>
<?php $this->endWidget(); ?>




    <!--/form-->

<?php Yii::app()->clientScript->registerScript('ajax-login-form-styles', '
$(document).on("submit", "#ajax-login-form", function(e){
    e.preventDefault();
    var form = $(this);
    var runAsElem = $("#'.CHtml::activeId($model, 'runAs').'");
    var additionalValue = (runAsElem.attr("type")=="checkbox"?(runAsElem.is(":checked")?"1":"0"):runAsElem.val());
    additionalValue = additionalValue == 1 ? "Client" : "User";
    var additionalParam = "?_run_as="+additionalValue;
    console.log(additionalValue,additionalParam);
    $.ajax({
        type: "POST",
        beforeSend: function(){
            form.find("input").removeClass("-error");
            form.find("[type=submit]").attr("disabled","disabled").append($("<i/>").addClass("fa fa-refresh fa-spin fa-fw margin-bottom loading-login"));
        },
        dataType: "json",
        url: form.attr("action")+additionalParam,
        data: form.serialize(), // serializes the form\'s elements.
        success: function(data)
        {
            form.find("[type=submit]").removeAttr("disabled").find(".loading-login").remove();
            if( data.hasOwnProperty("authenticated") && data["authenticated"] == true && data.hasOwnProperty("url"))
                location.href = data["url"];
            else {
                if(data.hasOwnProperty("errors")) {
                    var messages = \'\';
                    var cntErr = 0;
                    $.each(data["errors"], function (key, errors) {
                        form.find(\'#LoginForm_\' + key).addClass(\'-error\');
                        $.each(errors, function (k, error) {
                            cntErr++;
                            messages += (error + "\n");
                        })
                        if(cntErr == errors.length){
                            $.notify(messages, { globalPosition: "bottom right", className: "error"});

                            //alert(messages);
                            //createMessage(\'error\', messages, 5000);
                        }
                    })
                } else
                    alert(\'Unknown server error. Please try again later.\')
            }

        }
    });
});

$(document).on("change", "#LoginForm_runAs", function(){
    if($(this).is(":checked"))
    {
        '.setcookie('_run_as', md5(STEP_RUN_AS . 'Client' . STEP_RUN_AS), time() + 60 * 60 * 24 * 30, '/').';
        $(".register-link").removeAttr("disabled");
    }
    else
    {
    '.setcookie('_run_as', md5(STEP_RUN_AS . 'User' . STEP_RUN_AS), time() + 60 * 60 * 24 * 30, '/').';
        $(".register-link").attr("disabled", "disabled");
    }
})
', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerCss('ajax-login-form-styles', '
    #ajax-login-form .form-group{
        padding: 0 2px;
    }
    #ajax-login-form .form-group.login-run-as{
        padding-top: 2px;
    }
    #ajax-login-form .form-group input.form-control{
        width: 100%;
    }
'); ?>