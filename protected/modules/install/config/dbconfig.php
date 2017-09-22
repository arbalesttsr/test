<?php
$dbConfig = array(
    'mysql' => "
        'db'=>array(
            'connectionString' => 'mysql:host='.AP_DB_URL.';port=3306;dbname='.AP_DB_NAME,
            'emulatePrepare' => true,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
            'charset' => 'utf8',
        ),"
,
    'mssql' => "
         'db'=>array(
            'connectionString' => 'sqlsrv:Server='.AP_DB_URL.';Database='.AP_DB_NAME,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
        ),"
,
    'pgsql' => "
        'db'=>array(
            'connectionString' => 'pgsql:host='.AP_DB_URL.';port=5432;dbname='.AP_DB_NAME,
            'username' => AP_DB_USER,
            'password' => AP_DB_PASS,
            'charset' => 'utf8',
        ),"
);
?>