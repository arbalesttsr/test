<?php
/* @var $this DefaultController */


$this->pageTitle = Yii::app()->name . ' - Install Success';
?>


    <h3><?php echo Yii::t('UserModule.t', 'Users Module was successfully installed') ?></h3>

    <p>Now you may log in using <code>admin</code> username and <code>admin</code> password.</p>
<?php echo CHtml::link('Log In', Yii::app()->createUrl('user/site/login')); ?>