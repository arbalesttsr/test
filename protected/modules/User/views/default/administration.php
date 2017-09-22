<?php $this->breadcrumbs = array(
    $this->module->id
); ?>
<div class="col-md-12">
    <h4 class="timeline-month"><span><?= Yii::t('mess', 'Octombrie') ?></span> <span>2014</span></h4>
    <ul class="timeline">
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-play"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateUser') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Creare modul User') ?></h3>
                    <p><?= Yii::t('mess','userMsg') ?></p>
                </div>
                <hr/>
                <div class="timeline-content">
                    <p><?= Yii::t('mess','Actiunile principale ale Modulului User') ?></p>
                </div>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'user',
                                    'footer' => Yii::t('UserModule.t', 'REGISTER'),
                                    'href' => Yii::app()->createUrl('/User/user/register')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'inverse',
                                    'icon' => 'file-o',
                                    'footer' => Yii::t('UserModule.t', 'CERTIFICATES'),
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/certCertificateInfo/create')
                                )); ?>
                            </div>
                        </div>
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'warning',
                                    'icon' => 'group',
                                    'footer' => Yii::t('UserModule.t', 'USERS'),
                                    'href' => Yii::app()->createUrl('/User/user/admin')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'warning',
                                    'icon' => 'group',
                                    'footer' => Yii::t('UserModule.t', 'MANAGE_CLIENTS'),
                                    'href' => Yii::app()->createUrl('/User/Client/admin')
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="timeline-success">
            <div class="timeline-icon"><i class="fa fa-sitemap"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateUser') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Componente modul User') ?></h3>
                    <p><?= Yii::t('mess','compMsg') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-5">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'indigo',
                                    'heading' => Yii::t('mess','Role Based Access Manager'),
                                    'icon' => 'eye',
                                    'text' => 'RBAM',
                                    'href' => Yii::app()->createUrl('/User/default/getRbamIframe')
                                )); ?>
                            </div>
                            <div class="col-md-7">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'inverse',
                                    'heading' => Yii::t('mess','Logare prin Centrul de Telecomunicații Speciale'),
                                    'icon' => 'retweet',
                                    'text' => 'LoginMPass',
                                    'href' => Yii::app()->createUrl('/User/LoginCTS/default/administration')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'green',
                                    'heading' => Yii::t('mess','Logare din Baza de Date'),
                                    'icon' => 'folder-open-o',
                                    'text' => 'LoginDB',
                                    'href' => Yii::app()->createUrl('/User/LoginDB/default/administration')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'orange',
                                    'heading' => Yii::t('mess','Logare Active Directory'),
                                    'icon' => 'folder-hdd-o',
                                    'text' => 'LoginLDAP',
                                    'href' => Yii::app()->createUrl('/User/LoginAD/default/administration')
                                )); ?>
                            </div>
                            <div class="col-md-7">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'primary',
                                    'heading' => Yii::t('mess','Logare prin Certificate'),
                                    'icon' => 'folder-file-o',
                                    'text' => 'LoginCertificates',
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/default/administration')
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="timeline-warning">
            <div class="timeline-icon"><i class="fa fa-pencil"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateUser') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Monitorizare modul') ?></h3>
                    <p><?= Yii::t('mess','monitoringMsg') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'midnightblue',
                                    'heading' => Yii::t('mess','Utilizatori Inregistrati'),
                                    'icon' => 'group',
                                    'text' => User::getAllUsersRegistered(),
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'danger',
                                    'heading' => Yii::t('mess','Utilizatori Blocati'),
                                    'icon' => 'meh-o',
                                    'text' => User::getAllUsersBlocked(),
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'inverse',
                                    'icon' => 'file-o',
                                    'heading' => Yii::t('mess', 'Service Access') . " IP",
                                    'href' => Yii::app()->createUrl('/User/SaAccess/admin')
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<!--span class="info-tiles tiles-toyo">
    <div class="tiles-heading">Profit</div>
    <div class="tiles-body-alt">
        <div class="text-center"><span class="text-top"></span>User</div>
        <small>Administration</small>
    </div>
    <div class="tiles-footer"></div>
</span-->

<?php
/*if (Yii::app()->getUser()->isSa()) {
?>
<div class="span8">
    <div class="row-fluid">
        <div class="span4">
            <a href="" class="widget-stats" style="height:90px;">
                <span class="glyphicons group"><i></i></span>
                <span class="txt"><strong><?php echo User::getAllUsersRegistered(); ?></strong> users registered</span>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="span4">
            <a href="" class="widget-stats" style="height:90px;">
                <span class="glyphicons user_remove"><i></i></span>
                <span class="txt"><strong><?php echo User::getAllUsersBlocked(); ?></strong>users blocked</span>
                <div class="clearfix"></div>
            </a>
        </div>

    </div>
</div>
<?php }*/ ?>