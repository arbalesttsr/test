<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileWrite
 *
 * @author Administrator
 */
class HelperFileModul
{
    //put your code here    

    public static function Read()
    {
        $arr_modulesData = array();
        $strFileName = Yii::app()->basePath . "/data/Modules.txt";
        if (file_exists($strFileName)) {
            $total_list = file_get_contents($strFileName);
            $arr_modulesData = explode(";", $total_list);
        }
        return $arr_modulesData;
    }

    public static function Write($name)
    {
        $strFileName = Yii::app()->basePath . "/data/Modules.txt";
        $newLine = $name . ";";

        //FULL LOGS
        if (file_exists($strFileName)) {
            $objFopen = fopen($strFileName, 'a+');
        } else {
            $objFopen = fopen($strFileName, 'w+');
        }
        fwrite($objFopen, $newLine);
        fclose($objFopen);
    }

    public static function Clear()
    {
        $strFileName = Yii::app()->basePath . "/data/Modules.txt";
        $objFopenNotification = fopen($strFileName, 'w');
        fwrite($objFopenNotification, "");
        fclose($objFopenNotification);
    }

}

?>
