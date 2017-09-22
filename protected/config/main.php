<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


$config = array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Synapsis',
    'theme' => 'avant',//'user_theme',
    'sourceLanguage' => 'en_us',
    'language' => 'ro',
    'timeZone' => 'Europe/Chisinau',
    'aliases' => array(
        // Path to vendor dir
        'vendor' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor',
    ),
    // preloading 'log' component
    'preload' => array(
        'log',
        'booster'
    ),
    'charset' => 'UTF-8',
    'behaviors' => array(
        'onBeginRequest' => array(
            'class' => 'application.components.RequireLogin',
        )
    ),
    // autoloading model and component classes
    'import' => array(
        'ext.CrudUnit.*',
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.YiiMailer.*',
        'application.extensions.PNotify.*',
        'application.extensions.captchaExtended.*',
        'application.extensions.yii-debug-toolbar.*',
        'ext.giix-components.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            /*'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),*/
            'password' => '123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('*'),//array('212.56.197.2','::1'),
            'generatorPaths' => array(
                'application.gii', // <----- THIS IS THE LINE!!

            ),
        ),
    ),
    // application components
    'components' => array(

        /*'messages'=>array(

            'class'=>'CDbMessageSource',
            'sourceMessageTable'=> 'sourcemessage',
            'translatedMessageTable'=> 'message',
        ),*/

        'booster' => array(
            'class' => 'application.components.yiibooster.components.Booster',
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),

        'fixture' => array(
            'class' => 'system.test.CDbFixtureManager',
        ),

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                /*array( // your custom URL handler
                    'class' => 'application.components.SynapsisUrlRule',
                ),*/
            ),
        ),

        'securityManager' => array(
            'cryptAlgorithm' => 'rijndael-256',
            'encryptionKey' => '51Na45yS-@)!%OK!',
        ),


        'db' => array(
            'connectionString' => 'pgsql:host=' . AP_DB_URL . ';port=5432;dbname=' . AP_DB_NAME,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
            'charset' => 'utf8',
        ),

        'db_my' => array(
            'connectionString' => 'mysql:host=' . AP_DB_URL . ';port=3306;dbname=' . AP_DB_NAME,
            'emulatePrepare' => true,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
            'charset' => 'utf8',
        ),

        'db_ms' => array(
            //'class' => 'CDbConnection',
            'connectionString' => 'sqlsrv:Server=192.168.11.201\TFS;Database=modules_test_mssql',
            //'emulatePrepare' => false,
            'username' => 'sa',
            'password' => '123qweASD',
            //'charset' => 'utf8',
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                #...
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning, info',
                ),
            ),
        ),
        /*'session' => array (
            //'class' => 'application.components.DbHttpSession',
            'class' => 'application.components.AuditHttpSession',
            //'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'autoStart' => false,
            'sessionTableName' => 'sys_session',
            //'userTableName' => 'user',
            'autoCreateSessionTable' => true
        ),*/
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'language' => array('ru' => 'Русский', 'ro' => 'Română', 'en' => 'English'),
    ),
);

$dbConfig = array();
$conn = $config['components']['db'];
$connectionString = $conn['connectionString'];
$connStringArr = explode(':', $connectionString);
$dbConfig['typedb'] = $connStringArr[0];
$connStringArr = explode(';', $connStringArr[1]);
foreach ($connStringArr as $connStringEl) {
    $tmp = explode('=', $connStringEl);
    $dbConfig[$tmp[0]] = $tmp[1];
}
$dbConfig['username'] = $conn['username'];
$dbConfig['password'] = $conn['password'];

//$arr_modules = array(AP_YII_UMODULE);
$arr_modules = array('User');
$query_activ_modules = "select name from sys_modules where activ = 1;";
switch (strtolower($dbConfig['typedb'])) {
    case('mysql'): {
        mysql_connect($dbConfig['host'], $dbConfig['username'], $dbConfig['password']) or die("Could not connect: " . mysql_error());
        mysql_select_db($dbConfig['dbname']);

        $modules = mysql_query($query_activ_modules);

        while ($module = mysql_fetch_array($modules, MYSQL_NUM)) {
            $arr_modules[] = $module[0];
        }
        break;
    }
    case('pgsql'): {
        $db = pg_connect("host=" . $dbConfig['host'] . " port=" . $dbConfig['port'] . " dbname=" . $dbConfig['dbname'] . " user=" . $dbConfig['username'] . " password=" . $dbConfig['password']) or die("Could not connect: " . pg_last_error());

        $modules = pg_query($db, $query_activ_modules);
        if (pg_num_rows($modules))
            while ($module = pg_fetch_assoc($modules))
                $arr_modules[] = $module['name'];
        break;
    }
    case('mssql'):
    case('sqlsrv'):
    case('dblib'): {//die(var_dump($dbConfig));
        $connectionInfo = array("Database" => $dbConfig['Database'], "UID" => $dbConfig['username'], "PWD" => $dbConfig['password']);
        $conn = sqlsrv_connect($dbConfig['Server'], $connectionInfo);

        if (!$conn) die(print_r(sqlsrv_errors(), true));


        $stmt = sqlsrv_query($conn, $query_activ_modules);
        //die( var_dump( $stmt) );
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
//die(var_dump(sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)));
        //if(sqlsrv_num_rows( $stmt ))
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { //die(var_dump($row));
            $arr_modules[] = $row['name'];
        }
        //die(var_dump($arr_modules));
        break;
    }
}

$arr_modules = array_unique($arr_modules);
//die(var_dump('<pre>',$arr_modules,'</pre>'));
$modules_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
$handle = opendir($modules_dir);
foreach ($arr_modules as $module_name)
    $config = CMap::mergeArray($config, recursiveAppendModule($modules_dir . $module_name));
//$config = CMap::mergeArray($config, require($modules_dir . $module_name . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));

closedir($handle);

function recursiveAppendModule($modulePath)
{
    $tmp_conf = array();
    $configFile = $modulePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';
    if (file_exists($configFile))
        $tmp_conf = CMap::mergeArray($tmp_conf, require($configFile));

    if (is_dir($modulePath . DIRECTORY_SEPARATOR . 'modules')) {
        $handle = opendir($modulePath . DIRECTORY_SEPARATOR . 'modules');
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && is_dir($modulePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $file))
                $tmp_conf = CMap::mergeArray($tmp_conf, recursiveAppendModule($modulePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $file));

        }

        $tmp_conf = CMap::mergeArray($tmp_conf, require($configFile));
    }
    return $tmp_conf;
}


/*
           $strFileName = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'Modules.txt';
           
            if(file_exists($strFileName))
            {
                $total_list = file_get_contents($strFileName);
                $arr_modules = explode(";",$total_list);
            }
while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != ".." && is_dir($modules_dir . $file)) {
        if (in_array($file, $arr_modules) || $file === 'User')
            $config = CMap::mergeArray($config, require($modules_dir . $file . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));
    }
}
closedir($handle);*/
//die(var_dump('<pre>',$config,'</pre>'));
$config["import"] = super_unique($config["import"]);

$config["components"]["user"]["loginUrl"] = super_unique($config["components"]["user"]["loginUrl"]);

return $config;

function super_unique($array)
{
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

    foreach ($result as $key => $value) {
        if (is_array($value)) {
            $result[$key] = super_unique($value);
        }
    }

    return $result;
}
