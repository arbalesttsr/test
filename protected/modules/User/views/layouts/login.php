<?php $this->beginContent(); ?>

    <div id="login">
        <?php
        echo $content;
        ?>
        <!--div class="verticalcenter form-login-content">
        <span><img src="<?= Yii::app()->theme->baseUrl; ?>/assets/img/logo-big.png" alt="Logo" class="brand" /></span>
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="text-center" style="margin-bottom: 25px;">Log in to get started or <a href="extras-signupform.php">Sign Up</a></h4>
                <form action="#" class="form-horizontal" style="margin-bottom: 0px !important;">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="username" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                    </div>
                </form>

            </div>
            <div class="panel-footer">
                <a href="extras-forgotpassword.php" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>

                <div class="pull-right">
                    <a href="#" class="btn btn-default">Reset</a>
                    <a href="index.php" class="btn btn-primary">Log In</a>
                </div>
            </div>
        </div>
    </div-->
    </div>
<?php Yii::app()->clientScript->registerScript('add-class-to-body-login',
    '$("body").addClass("focusedform");
    //$("div#page-container").html($("div.form-login-content"));
    ', CClientScript::POS_LOAD); ?>


<?php $this->endContent(); ?>