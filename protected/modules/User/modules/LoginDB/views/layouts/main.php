<?php $this->beginContent();
$this->widget('application.components.widgets.usertheme.ModuleMenuWidget', array(
    'label' => Yii::t('base', 'OPTIONS'),
    'icon' => 'more',
    'items' => array(
        array('label' => Yii::t('UserModule.t', 'Service Access'), 'url' => Yii::app()->createUrl('/User/serviceAccess/admin')),
        array('label' => Yii::t('UserModule.t', 'USERS'), 'url' => Yii::app()->createUrl('/User/user/admin')),
        //array('label' => Yii::t('UserModule.t','PROFILES'), 'url'=>Yii::app()->createUrl('/User/profile/admin')),
        //array('label' => Yii::t('UserModule.t','FIELDS'), 'url'=>Yii::app()->createUrl('/User/profile/fields')),
        array('label' => Yii::t('UserModule.t', 'CERTIFICATES'), 'url' => Yii::app()->createUrl('/User/certificate/create')),
        array('label' => Yii::t('UserModule.t', 'IP Access'), 'url' => Yii::app()->createUrl('/User/saAccess/admin')),
    )));
?>

    <div id="content">
        <?php
        echo $content;
        ?>
    </div>
<?php $this->endContent(); ?>