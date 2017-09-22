<?php $this->beginContent();
$this->widget('application.components.widgets.usertheme.ModuleMenuWidget', array(
        'label' => Yii::t('base', 'OPTIONS'),
        'icon' => 'more',
        'items' => array(
            array('label' => Yii::t('UserModule.t', 'USERS'), 'url' => Yii::app()->createUrl('/User/user/admin')),
            array('label' => Yii::t('UserModule.t', 'SETTINGS'), 'url' => Yii::app()->createUrl('/User/LoginCertificates/certSettings/admin')),
            array('label' => Yii::t('UserModule.t', 'CERTIFICATES'), 'url' => Yii::app()->createUrl('/User/LoginCertificates/certCertificateInfo/admin')),

        ),
    )
);
?>

    <div id="content">
        <?php
        echo $content;
        ?>
    </div>
<?php $this->endContent(); ?>