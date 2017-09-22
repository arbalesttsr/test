<?php

/**
 * Created by PhpStorm.
 * User: birca
 * Date: 1/26/15
 * Time: 2:49 PM
 */
class SynapsisUrlRule extends CBaseUrlRule
{

    private $key = "51Na45yS-@)!%OK!";

    public function createUrl($manager, $route, $params, $ampersand)
    {

        $all_url = $route;
        if (count($params) > 0 || count($_GET) > 0) {
            $mixed_params = array();
            foreach ($params as $key => $value) {
                if (!is_array($value))
                    $mixed_params[$key] = $value;
            }

            foreach ($mixed_params as $key_param => $value_param)
                $all_url .= ('/' . $key_param . '/' . $value_param);
        }

        if (strpos(strtolower($all_url), "/rbam") == true || strpos(strtolower($all_url), "/sharepoint") == true)
            return $all_url;

        $exceptions = LoginException::model()->findAllByAttributes(array('type' => '1'));
        foreach ($exceptions as $exception) {
            if (strtolower($exception->action) == strtolower($all_url)) {
                return $all_url;
            }
        }

        return strtr(base64_encode(Yii::app()->getSecurityManager()->encrypt($all_url)), '+/=', '-_,');

    }

    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        //return parent::parseUrl($manager,$request,$pathInfo,$rawPathInfo);
        if (strpos(strtolower($pathInfo), "/rbam") == true || strpos(strtolower($pathInfo), "/sharepoint") == true)
            return $pathInfo;

        $exceptions = LoginException::model()->findAllByAttributes(array('type' => '1'));
        foreach ($exceptions as $exception) {
            if (strtolower($exception->action) == strtolower($pathInfo)) {
                return $pathInfo;
            }
        }

        if (trim($pathInfo) == '' || $pathInfo == 'site/index')
            return '';

        if (strlen($pathInfo) <= 43)
            throw new CHttpException(404, 'Adresa url nu este valida');

        try {
            $pathInfo = Yii::app()->getSecurityManager()->decrypt(base64_decode(strtr($pathInfo, '-_,', '+/=')));
            //die($pathInfo);
            //die($pathInfo);
            //die(var_dump($pathInfo));
            return $pathInfo;
        } catch (CHttpException $e) {
            throw new CHttpException(404, 'Adresa url nu este valida');
            return $pathInfo;
        }

    }
}