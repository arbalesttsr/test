<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL ^ E_DEPRECATED);


// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'sourceLanguage'=>'en_us',
	'language'=>'ro',
	'timeZone' => 'Europe/Chisinau',
	'charset'=>'UTF-8',
	'name'=>'ifps',

	// preloading 'log' component
	'preload'=>array('log'),
	//'commandPath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.'/modules/WorkFlow/commands/',

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'ext.giix-components.*',
		'application.extensions.YiiMailer.*',
	),

	// application components
	'components'=>array(

        'db' => array(
            'connectionString' => 'pgsql:host=' . AP_DB_URL . ';port=5432;dbname=' . AP_DB_NAME,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
            'charset' => 'utf8',
        ),

		"request" => array(
			'hostInfo' => 'http://localhost',
			'baseUrl' => '',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<language:(ru|ro|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<language:(ru|ro|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<language:(ru|ro|en)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<language:(ru|ro|en)>/<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
				'<language:(ru|ro|en)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<language:(ru|ro|en)>/<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
	),
);

$dbConfig = array();
$conn = $config['components']['db'];
$connectionString = $conn['connectionString'];
$connStringArr = explode(':', $connectionString);
$dbConfig['typedb'] = $connStringArr[0];
$connStringArr = explode(';', $connStringArr[1]);
foreach($connStringArr as $connStringEl)
{
	$tmp = explode('=', $connStringEl);
	$dbConfig[$tmp[0]] = $tmp[1];
}
$dbConfig['username'] = $conn['username'];
$dbConfig['password'] = $conn['password'];

$query_activ_modules = "select name from sys_modules where activ = 1;";
switch(strtolower($dbConfig['typedb']))
{
	case('mysql'):
	{
		mysql_connect($dbConfig['host'], $dbConfig['username'], $dbConfig['password']) or die("Could not connect: " . mysql_error());
		mysql_select_db($dbConfig['dbname']);

		$modules = mysql_query($query_activ_modules);

		while ($module = mysql_fetch_array($modules, MYSQL_NUM)) {
			$arr_modules[] = $module[0];
		}
		break;
	}
	case('pgsql'):
	{
		$db = pg_connect("host=".$dbConfig['host']." port=".$dbConfig['port']." dbname=".$dbConfig['dbname']." user=".$dbConfig['username']." password=".$dbConfig['password']) or die("Could not connect: " . pg_last_error());

		$modules = pg_query($db, $query_activ_modules);
		if(pg_num_rows($modules))
			while($module = pg_fetch_assoc($modules))
				$arr_modules[] = $module['name'];
		break;
	}
	case('mssql'):
	case('sqlsrv'):
	case('dblib'):
	{//die(var_dump($dbConfig));
		$connectionInfo = array( "Database"=>$dbConfig['Database'], "UID"=>$dbConfig['username'], "PWD"=>$dbConfig['password']);
		$conn = sqlsrv_connect( $dbConfig['Server'], $connectionInfo);

		if( !$conn ) die( print_r( sqlsrv_errors(), true));


		$stmt = sqlsrv_query( $conn, $query_activ_modules );
		//die( var_dump( $stmt) );
		if( $stmt === false) {
			die( print_r( sqlsrv_errors(), true) );
		}
//die(var_dump(sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)));
		//if(sqlsrv_num_rows( $stmt ))
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { //die(var_dump($row));
			$arr_modules[] =  $row['name'];
		}
		//die(var_dump($arr_modules));
		break;
	}
}

$arr_modules = array_unique($arr_modules);
foreach($arr_modules as $k => $module)
	if($module == 'User' || $module == 'Client')
		unset($arr_modules[$k]);
//$arr_modules = array('WorkFlow','Documents','FilesManager','Routies','Notification','Ticketing','Client','Clasificator');
$arr_modules[] = 'User';
$modules_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR;
$handle = opendir($modules_dir);
foreach($arr_modules as $module_name)
	$config = CMap::mergeArray($config,recursiveAppendModule($modules_dir . $module_name));
//$config = CMap::mergeArray($config, require($modules_dir . $module_name . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php'));

closedir($handle);

function recursiveAppendModule($modulePath)
{
	$tmp_conf = array();
	$configFile = $modulePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'console.php';
	if(file_exists($configFile))
		$tmp_conf = CMap::mergeArray($tmp_conf, require($configFile));
	else
	   {
		$configFile = $modulePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';
        	if(file_exists($configFile))
                	$tmp_conf = CMap::mergeArray($tmp_conf, require($configFile));

	   }

	if(is_dir($modulePath . DIRECTORY_SEPARATOR . 'modules'))
	{
		$handle = opendir($modulePath . DIRECTORY_SEPARATOR . 'modules');
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != ".." && is_dir($modulePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $file))
				$tmp_conf = CMap::mergeArray($tmp_conf, recursiveAppendModule($modulePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $file));

		}

		$tmp_conf = CMap::mergeArray($tmp_conf, require($configFile));
	}
	return $tmp_conf;
}


return $config;
