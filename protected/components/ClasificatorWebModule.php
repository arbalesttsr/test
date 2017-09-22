<?php

/**
 * Created by PhpStorm.
 * User: urechean
 * Date: 30.06.2016
 * Time: 11:06
 */
class ClasificatorWebModule extends CWebModule
{
    private $_controllerPath;
    private $_viewPath;

    public function getControllerPath()
    {
        if (strpos(Yii::app()->request->pathinfo, '/') !== false || strlen(Yii::app()->request->pathinfo) <= 43)
            $pathinfo = Yii::app()->request->pathinfo;
        else {
            $pathinfo = Yii::app()->getSecurityManager()->decrypt(base64_decode(strtr(Yii::app()->request->pathinfo, '-_,', '+/=')));
        }

        if($this->_controllerPath!==null)
            return $this->_controllerPath;
        else
        {
            $pathinfoArr = explode("/",$pathinfo);

            if($pathinfoArr[1] == "Clasificator")
                $cont = $pathinfoArr[2];
            else
                $cont = $pathinfoArr[1];

            if(in_array(strtolower($cont),
                [
                    'admincl',
                    'createcl',
                    'default',
                    'limitacces',
                ]))
                return $this->_controllerPath = $this->getBasePath().DIRECTORY_SEPARATOR.'controllers_backend';
            else
                return $this->_controllerPath=$this->getBasePath().DIRECTORY_SEPARATOR.'controllers';
        }
    }

    public function getViewPath()
    {
        if (strpos(Yii::app()->request->pathinfo, '/') !== false || strlen(Yii::app()->request->pathinfo) <= 43)
            $pathinfo = Yii::app()->request->pathinfo;
        else {
            $pathinfo = Yii::app()->getSecurityManager()->decrypt(base64_decode(strtr(Yii::app()->request->pathinfo, '-_,', '+/=')));
        }

        if($this->_viewPath!==null)
            return $this->_viewPath;
        else
        {
            $pathinfoArr = explode("/",$pathinfo);

            if($pathinfoArr[1] == "Clasificator")
                $cont = $pathinfoArr[2];
            else
                $cont = $pathinfoArr[1];

            if(in_array(strtolower($cont),
                [
                    'admincl',
                    'createcl',
                    'default',
                    'limitacces',
                ]))
                return $this->_viewPath=$this->getBasePath().DIRECTORY_SEPARATOR.'views_backend';
            else
                return $this->_viewPath=$this->getBasePath().DIRECTORY_SEPARATOR.'views';
        }
    }
}