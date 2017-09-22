<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 10/1/14
 * Time: 14:51 PM
 */

//echo 'adiministration DB';

?>
<!--div class="jumbotron">
        <h1><?php echo Yii::t('base', 'ADMINISTRATION') ?> LoginDB</h1>


    </div-->
<?php $this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginDB',
); ?>
<div class="col-md-12">
    <h4 class="timeline-month"><span><?= Yii::t('mess','Octombrie') ?></span> <span>2014</span></h4>
    <ul class="timeline">
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-play"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateDB') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Creare modul LoginDB') ?></h3>
                    <p><?= Yii::t ('mess', 'A fost creat modulul de logare prin Baza de date') ?></p>
                </div>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-12">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'user',
                                    'footer' => Yii::t('UserModule.t', 'REGISTER'),
                                    'href' => Yii::app()->createUrl('/User/user/register')
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
                                    'color' => 'success',
                                    'icon' => 'group',
                                    'footer' => Yii::t('UserModule.t', 'MANAGE_CLIENTS'),
                                    'href' => Yii::app()->createUrl('/User/Client/admin')
                                )); ?>
                            </div>
                        </div>
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'inverse',
                                    'icon' => 'group',
                                    'footer' => Yii::t('UserModule.t', 'MANAGE_SQL_USERS'),
                                    'href' => Yii::app()->createUrl('/User/user/adminSqlUser')
                                )); ?>
                            </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'inverse',
                                    'icon' => 'group',
                                    'footer' => Yii::t('UserModule.t', 'MANAGE_CLI_SQL_USERS'),
                                    'href' => Yii::app()->createUrl('/User/user/adminCliSqlUser')
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>