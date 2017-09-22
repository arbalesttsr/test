<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 10/1/14
 * Time: 14:49 PM
 */

//echo 'administration CTS';
/*$this->menu=array(
		array('label' => Yii::t('UserModule.t','SETTINGS'), 'url'=>array('/User/LoginCTS/ctsSettings/admin')),
                array('label' => Yii::t('UserModule.t','CREATE_SETTING'), 'url'=>array('/User/LoginCTS/ctsSettings/create')),
		array('label' => Yii::t('UserModule.t','USERS'), 'url'=>array('/User/user/admin')),
		
);*/

?>

<!--div class="jumbotron">
        <h1><?php echo 'ADMINISTRATION'; ?> LoginCTS</h1>


    </div-->

<?php $this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS',
); ?>

<div class="col-md-12">
    <h4 class="timeline-month"><span><?= Yii::t('mess','Octombrie') ?></span> <span>2014</span></h4>
    <ul class="timeline">
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-play"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateUser') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Creare modul LoginCTS') ?></h3>
                    <p><?= Yii::t('mess','A fost creat modulul de logare prin Centrul de Telecomunicații Speciale.') ?></p>
                </div>
            </div>
        </li>
        <li class="timeline-info">
            <div class="timeline-icon"><i class="fa fa-sitemap"></i></div>
            <div class="timeline-body">
                <div class="timeline-header">
                    <span class="author">Posted by <a href="#">Vitalii Birca</a></span>
                    <span class="date"><?= Yii::t('mess','dateUser') ?></span>
                </div>
                <div class="timeline-content">
                    <h3><?= Yii::t('mess','Componente modul LoginCTS') ?></h3>
                    <p><?= Yii::t('mess','Actiunile principale ale modulului LoginCTS.') ?></p>
                </div>
                <hr/>
                <div class="timeline-footer">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'plus-circle',
                                    'footer' => Yii::t('mess', 'CREATE_SETTING'),
                                    'href' => Yii::app()->createUrl('/User/LoginCTS/ctsSettings/create')
                                )); ?>
                            </div>
                        </div>
                            <div class="col-md-6">
                                <?php $this->widget('application.components.widgets.usertheme.AvantTiles', array(
                                    'type' => 'shortcut',
                                    'color' => 'info',
                                    'icon' => 'gear',
                                    'footer' => Yii::t('mess', 'SETTINGS'),
                                    'href' => Yii::app()->createUrl('/User/LoginCTS/ctsSettings/admin')
                                )); ?>
                            </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>