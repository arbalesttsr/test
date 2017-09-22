<?php $this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->name => array("{$this->module->id}/default/administration"),
); ?>
<div class="col-md-12">
    <h4 class="timeline-month"><span><?= Yii::t('mess','Februarie') ?></span> <span>2015</span></h4>
    <ul class="timeline">
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-play"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Tudor Victor</a></span>
                    <span class="date"><?= Yii::t('mess', 'date1LoginCert') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess', 'Modulul LoginCertificates') ?></h3>
                </div>
                <hr/>
                <div class="timeline-content">
                    <p><?= Yii::t('mess', 'Actiunile principale ale Modulului LoginCertificates') ?></p>
                </div>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'midnightblue',
                                    'icon' => 'plus',
                                    'footer' => Yii::t('mess', 'CREATE_CERTIFICATE_SETTINGS'),
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/certSettings/create')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'midnightblue',
                                    'icon' => 'plus',
                                    'footer' => Yii::t('mess', 'Create CertificateInfo'),
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/certCertificateInfo/create')
                                )); ?>
                            </div>
                        </div>
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'gears',
                                    'footer' => Yii::t('mess', 'MANAGE_CERTIFICATE_SETTINGS'),
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/certSettings/admin')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'gears',
                                    'footer' => Yii::t('mess', 'Manage CertificateInfo'),
                                    'href' => Yii::app()->createUrl('/User/LoginCertificates/certCertificateInfo/admin')
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
                    <span class="author">Posted by <a href="#">Tudor Victor</a></span>
                    <span class="date"><?= Yii::t('mess','date2LoginCert') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Monitorizare modul') ?></h3>
                    <p><?= Yii::t('mess','Monitorizarea numarului de configurari certificate in Synapsis') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'primary',
                                    'heading' => Yii::t('mess','Utilizatori Inregistrati'),
                                    'icon' => 'users',
                                    'text' => User::getAllUsersRegistered(),
                                    'href' => '#'
                                )); ?>
                            </div>

                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'success',
                                    'heading' => Yii::t('mess','Users with Certificates'),
                                    'icon' => 'file-o',
                                    'text' => User::getAllUsersWithCertificates(),
                                    'href' => '#'
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'info',
                                    'heading' => Yii::t('mess','Number of Certificate Settings'),
                                    'icon' => 'list',
                                    'text' => CertSettings::GetNumberCertificateSettings(),
                                    'href' => '#'
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-info"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Tudor Victor</a></span>
                    <span class="date"><?= Yii::t('mess','date1LoginCert') ?></span>
                </div>
                <div class="timeline-content">
                    <p><?= Yii::t('mess','message1') ?></p>

                    <p><?= Yii::t('mess','message2') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div id="carousel-example-captions" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-body">
                                            <h1><span class="label label-info"><?= Yii::t('mess','Pasul 1') ?></span></h1>
                                            <div class="alert alert-dismissable alert-success">
                                                <h3><?= Yii::t('mess','Crearea unei configurari Certificat Setting pentru a genera corect certificatul') ?></h3>
                                                <p><?= Yii::t('mess','Pentru a crea o configurare pentru Certificat este necesar sa cunoastem urmatoarele date:') ?></p>
                                                <ul>
                                                    <li><?= Yii::t('mess','calea unde se va salva certificatul : "/data/certificates/"') ?></li>
                                                    <li><?= Yii::t('mess','calea unde se va salva key : "/data/keys/"') ?></li>
                                                    <li><?= Yii::t('mess','calea unde se afla fisier de config openssl : "/data/sslconfig/" (*)') ?>
                                                    </li>
                                                    <li><?= Yii::t('mess','setarea digest algorithm : "SHA512" (recommended)') ?></li>
                                                    <li><?= Yii::t('mess','setarea Private Key Bits : 2048 (recommended)') ?></li>
                                                    <li><?= Yii::t('mess','setarea Private Key Type : OPENSSL_KEYTYPE_RSA (recommended)') ?>
                                                    </li>

                                                    <br>
                                                    <p>
                                                        <a class="btn btn-success"
                                                           href="<?= Yii::app()->createUrl('/User/LoginCertificates/certSettings/create') ?>"><?= Yii::t('mess','CREATE_CERTIFICATE_SETTINGS') ?></a>

                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-body">
                                            <h1><span class="label label-info"><?= Yii::t('mess','Pasul 2') ?></span></h1>
                                            <div class="alert alert-dismissable alert-success">
                                                <h3><?= Yii::t('mess','Creare Certificate') ?> </h3>
                                                <p><?= Yii::t('mess','Dupa ce am creat o configurare pentru certificat, cream o creeam insasi certificatul care utilizatorul o sa l foloseasca.') ?></p>
                                                <br>
                                                <p>
                                                    <a class="btn btn-success"
                                                       href="<?= Yii::app()->createUrl('/User/LoginCertificates/certCertificateInfo/create') ?>"><?= Yii::t('mess','Create CertificateInfo') ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item row">
                                <div class="col-md-12">
                                    <div class="panel panel-success">
                                        <div class="panel-body">
                                            <h1><span class="label label-info"><?= Yii::t('mess','Pasul 3') ?></span></h1>
                                            <div class="alert alert-dismissable alert-success">
                                                <h3><?= Yii::t('mess','Dupa ce s-a creat certificatul , il vizualizam si accesam butonul Download Key, pentru a descarca certificatul') ?></h3>
                                                <p><?= Yii::t('mess','Descrierea va fi in curind ...') ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">
                            <span class="fa fa-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-captions" data-slide="next">
                            <span class="fa fa-next"></span>
                        </a-->
                        <div class="col-md-12" style="text-align: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-target="#carousel-example-captions"
                                        data-slide-to="0">1
                                </button>
                                <button type="button" class="btn btn-default" data-target="#carousel-example-captions"
                                        data-slide-to="1">2
                                </button>
                                <button type="button" class="btn btn-default" data-target="#carousel-example-captions"
                                        data-slide-to="2">3
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
