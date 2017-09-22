<?php
define("STEP_RUN_AS", '?s23a4A1ekGEK12N0Vv65086IyTt&nu@');
checkFromRun();
$run_as = md5(STEP_RUN_AS . 'User' . STEP_RUN_AS) == $_COOKIE['_run_as'] ? 'User' : 'Client';
$not_run_as = 'User' == $run_as ? 'Client' : 'User';
// change the following paths if necessary

define("AP_DB_URL", "localhost");
define("AP_DB_NAME", "test_documentatie2");
define("AP_DB_USER", "public_root");
define("AP_DB_PASS", "123qweASDZXC");
define("AP_YII_PATH", "../../framework/yii.php");
define("AP_YII_UMODULE", $run_as);
define("AP_YII_NUMODULE", $not_run_as);

//define("YII_ENABLE_ERROR_HANDLER", false);
//define("YII_ENABLE_EXCEPTION_HANDLER", false);


$config = dirname(__FILE__) . '/protected/config/main.php';
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
require_once(AP_YII_PATH);
//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(E_ALL ^ E_DEPRECATED);
Yii::createWebApplication($config)->run();

/*
 * check module to run [User|Client]
 */
function checkFromRun()
{
    if(strpos($_SERVER['REQUEST_URI'], '/User/site/loginAjax') === 0 && isset($_GET['_run_as'])){
        $_run_as = ucfirst(strtolower($_GET['_run_as']));
        if(!in_array($_run_as, ['User','Client']))
            $_run_as = 'Client';
        setModule($_run_as);
    }elseif (isset($_GET['_run_as'])) {
        $_run_as = $_GET['_run_as'];
        if (strtolower($_run_as) !== 'user')
            $_run_as = 'client';
        $_run_as = ucfirst(strtolower($_run_as));

        if (isset($_COOKIE['_run_as'])) {
            if ($_COOKIE['_run_as'] !== md5(STEP_RUN_AS . $_run_as . STEP_RUN_AS)) {
                logout($_run_as);
            }
            //else case is when get variable is same to browser saved variable
        } else logout($_run_as);
    } elseif (isset($_COOKIE['_run_as'])) {
        $_run_as = md5(STEP_RUN_AS . 'User' . STEP_RUN_AS) == $_COOKIE['_run_as'] ? 'User' : 'Client';

        setModule($_run_as);
    } else {
        logout();
    }
}

/*
 * set selected module to cookies
 */
function setModule($start_module = 'Client')
{
    if (strtolower($start_module) !== 'user')
        $start_module = 'Client';
    else $start_module = 'User';

    setcookie('_run_as', md5(STEP_RUN_AS . $start_module . STEP_RUN_AS), time() + 60 * 60 * 24 * 30, '/');
}

/*
 * logout from selected module
 */
function logout($start_module = 'Client')
{
    //please change $host and $action variables when you change web-app host or logout action from web-app

    $host = getCompleteHost();
    $action = 'site/logout';
    //$action = 'QOu2fWsnjPlKgGIpz9WVb-jwhf4LASzqeot0XUU1esGmZC8jZhdqxYQ4O-yGadxXlaXNx4SNs_ysibCZNGWQkQ';

    setModule($start_module);
    header("Location: " . $host . $action);
    exit();
}

/*
 * get application host, from port or from some www folder
 */
function getCompleteHost()
{
    $scheme = $_SERVER['REQUEST_SCHEME'];
    $host = $_SERVER['HTTP_HOST'];
    $add_data = getIntersection($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);
    //die(var_dump('http://' . $host . $add_data));
    return "$scheme://$host$add_data";
}

/*
 * function to get intersection of two strings
 */
function getIntersection($a = '', $b = '')
{
    $result = '';
    $len = strlen($a) > strlen($b) ? strlen($b) : strlen($a);
    for ($i = 0; $i < $len; $i++) {
        if (substr($a, $i, 1) == substr($b, $i, 1)) {
            $result .= substr($a, $i, 1);
        } else {
            break;
        }
    }
    return $result;
}