<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Synapsis </title>
    <?php /* ?><style type="text/css">
		<?php echo require 'css.css' ?>
	</style><?php */ ?>
    <?php Yii::app()->clientScript->registerCssFile(
        Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.install.views.layouts') . '/css.css')
    ); ?>
</head>
<body>
<div id="header">
    <div class="left">
        <span>Synapsis</span> <?= VERSION ?>
    </div>
    <div class="right">
        <!--			<a href="">Помощь в установке</a>-->
    </div>
</div>
<div id="content">
    <?php echo $content ?>
</div>
</body>
</html>
