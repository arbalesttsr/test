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
                    <span class="date"><?= Yii::t('mess','date1LoginCert') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Modulul LoginAD') ?></h3>
                </div>
                <hr/>
                <div class="timeline-content">
                    <p><?= Yii::t('mess','Actiunile principale ale Modulului LoginAD') ?></p>
                </div>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'gears',
                                    'footer' => Yii::t('mess', 'MANAGE_LDAP_SETTINGS'),
                                    'href' => Yii::app()->createUrl('/User/LoginAD/ldapSettings/admin')
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'gears',
                                    'footer' => Yii::t('mess', 'MANAGE_USER_LDAP_RELATION'),
                                    'href' => Yii::app()->createUrl('/User/LoginAD/userLdapRelation/admin')
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'warning',
                                    'icon' => 'exchange',
                                    'footer' => Yii::t('mess', 'IMPORT_LDAP_USERS'),
                                    'href' => Yii::app()->createUrl('/User/LoginAD/ldapSettings/importUserAd')
                                )); ?>
                            </div>
                        </div>
                        <div class="tab-pane active">
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'midnightblue',
                                    'icon' => 'plus',
                                    'footer' => Yii::t('mess', 'CREATE_LDAP_SETTINGS'),
                                    'href' => Yii::app()->createUrl('/User/LoginAD/ldapSettings/create')
                                )); ?>
                            </div>
                            <div class="col-md-4">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'midnightblue',
                                    'icon' => 'plus',
                                    'footer' => Yii::t('mess', 'CREATE_USER_LDAP_RELATION'),
                                    'href' => Yii::app()->createUrl('/User/LoginAD/userLdapRelation/create')
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
                    <p><?= Yii::t('mess','ADmess1') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'green',
                                    'heading' => Yii::t('mess','Numarul LDAP Settings'),
                                    'icon' => 'list-ol',
                                    'text' => LdapSettings::getNumberOfLdapSettings(),
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'info',
                                    'color' => 'green',
                                    'heading' => Yii::t('mess','Numarul UserLdapRelation'),
                                    'icon' => 'list-ol',
                                    'text' => UserLdapRelation::getNumberOfUserLdapRelation(),
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
                    <p><?= Yii::t('mess','instr mess1') ?></p>
                    <div class="alert alert-dismissable alert-warning">
                        <strong><?= Yii::t('mess','atentie') ?></strong> <?= Yii::t('mess','instr mess2') ?>
                    </div>
                    <p><?= Yii::t('mess','instr mess3') ?></p>
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
                                                <h3><?= Yii::t('mess','Crearea unei configurari LDAP prin intermediu modulului LoginAD') ?></h3>
                                                <p><?= Yii::t('mess','Pentru a crea o configurare LDAP este necesar sa cunoastem urmatoarele date:') ?></p>
                                                <ul>
                                                    <li><?= Yii::t('mess','Numele Utilizatorului din Active Direcory') ?></li>
                                                    <li style="color:slategray;"><?= Yii::t('mess','*Parola Utilizatorului din Active Direcory (in cazul nostru nu o pastram in sistem , ea se va introduce de utilizator la etapa de logare)') ?>
                                                    </li>
                                                    <li><?= Yii::t('mess','Host-ul unde se afla Active Directory') ?></li>
                                                    <li><?= Yii::t('mess','Portul pentru Active Directory (la majoritatea portul este : 389)') ?>
                                                    </li>
                                                    <li><?= Yii::t('mess','Domain Controler') ?></li>
                                                    <li><?= Yii::t('mess','Organisational-Unit') ?></li>

                                                    <br>
                                                    <p>
                                                        <a class="btn btn-success"
                                                           href="<?= Yii::app()->createUrl('/User/LoginAD/ldapSettings/create') ?>">
															<?= Yii::t('mess','Creare configurare LDAP') ?></a>

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
                                                <h3><?= Yii::t('mess','Creare UserLdapRelation configurare') ?> </h3>
                                                <p><?= Yii::t('mess','instr mess4') ?></p>
                                                <br>
                                                <p>
                                                    <a class="btn btn-success"
                                                       href="<?= Yii::app()->createUrl('/User/LoginAD/userLdapRelation/create') ?>">
														<?= Yii::t('mess','CREATE_USER_LDAP_RELATION') ?></a>
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
                                                <h3><?= Yii::t('mess','instr mess5') ?></h3>
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
