<?php $this->beginContent();
$this->widget('application.components.widgets.usertheme.ModuleMenuWidget', array(
    'label' => Yii::t('base', 'OPTIONS'),
    'icon' => 'more',
    'items' => array(
        array('label' => Yii::t('UserModule.t', 'CTS Default'), 'url' => Yii::app()->createUrl('/User/LoginCTS/default/administration')),
        array('label' => Yii::t('UserModule.t', 'USERS'), 'url' => Yii::app()->createUrl('/User/user/admin')),
    )));
?>

    <div id="content">
        <?php
        echo $content;
        ?>
    </div>
<?php $this->endContent(); ?>