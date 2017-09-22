<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelperCheckDB
 *
 * @author tudor
 */
class HelperCheckDB
{
    //put your code here
    const MYSQL = 'mysql';
    const PGSQL = 'pgsql';
    const MSSQL_1 = 'sqlsrv';
    const MSSQL_2 = 'dblib';
    const MSSQL_3 = 'mssql';

    /*
     * Check if Mysql connection database
     * @return true,false
     */
    public static function CheckDbConnectionTypeMysql()
    {
        $conn_type = Yii::app()->db->connectionString;
        // die(var_dump($conn_type));
        $conn_type = explode(':', $conn_type);
        $conn_type = $conn_type[0];

        if ($conn_type == self::MYSQL)
            return TRUE;
        else
            return FALSE;
    }

    /*
     * Check if PgSql connection database
     * @return true,false
     */
    public static function CheckDbConnectionTypePgsql()
    {
        $conn_type = Yii::app()->db->connectionString;
        // die(var_dump($conn_type));
        $conn_type = explode(':', $conn_type);
        $conn_type = $conn_type[0];

        if ($conn_type == self::PGSQL)
            return TRUE;
        else
            return FALSE;
    }

    /*
     * Check if MsSql connection database
     * @return true,false
     */
    public static function CheckDbConnectionTypeMssql()
    {
        $conn_type = Yii::app()->db->connectionString;
        $conn_type = explode(':', $conn_type);
        $conn_type = $conn_type[0];

        if ($conn_type == self::MSSQL_1) {
            return TRUE;
        } elseif ($conn_type == self::MSSQL_2) {
            return TRUE;
        } elseif ($conn_type == self::MSSQL_3) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /*
      * Get database connection type text
      * @return string
      */
    public static function GetDbConnectionTypeText()
    {
        $conn_type = Yii::app()->db->connectionString;
        $conn_type = explode(':', $conn_type);
        $conn_type = $conn_type[0];

        if ($conn_type == self::MSSQL_1) {
            return 'MSSQL';
        } elseif ($conn_type == self::MSSQL_2) {
            return 'MSSQL';
        } elseif ($conn_type == self::MSSQL_3) {
            return 'MSSQL';
        } elseif ($conn_type == self::PGSQL) {
            return 'PGSQL';
        } elseif ($conn_type == self::MYSQL) {
            return 'MYSQL';
        } else {
            return '';
        }
    }


}
