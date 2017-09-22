<?php

/**
 * Created by PhpStorm.
 * User: urechean
 * Date: 25.05.2015
 * Time: 15:07
 */
class ObjectEncoded
{

    public static function getObjectEncoded($model, $array, $format = 'json')
    {
        if (isset($_GET['format']))
            $format = $_GET['format'];

        if ($format == 'json') {
            return CJSON::encode($array);
        } elseif ($format == 'xml') {
            $result = '<?xml version="1.0" encoding="utf-8"?>';
            $result .= "\n<$model>\n";
            $result .= _array2xml($array);
            $result .= '</' . $model . '>';
            return $result;
        } else {
            return;
        }
    }

    private static function _array2xml($array)
    {
        $result = "";
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result .= "\n<_$key>\n";
                $result .= _array2xml($value);
                $result .= '</_' . $key . '>';
            } else
                $result .= "    <$key>" . utf8_encode($value) . "</$key>\n";
        }
        return $result;
    }
} 