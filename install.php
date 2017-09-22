<?php

$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'protected',
    'sourceLanguage' => 'ro',
    'modules' => array(
        'install',
    ),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'components' => array(
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            'rules' => array(
                '/' => 'install/default',
            )),
        'languageManager' => array(
            'class' => 'SLanguageManager'
        ),
    ),
    'params' => array(),
);

error_reporting(0);
define('VERSION', '1.0.0');

// change the following paths if necessary
define("AP_YII_PATH", "../../framework/yii.php");
require_once(AP_YII_PATH);
Yii::createWebApplication($config)->run();
