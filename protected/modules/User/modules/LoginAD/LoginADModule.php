<?php

class LoginADModule extends CWebModule
{
    public $applicationLayout = 'main';
    public $applicationLogin = 'login';

    public $front_tiles = array();
    public $ldap = array();

    public $baseUrl;
    /**
     * @property string The base script URL for all module resources (e.g. javascript,
     * CSS file, images).
     * If NULL (default) the integrated module resources (which are published as
     * assets) are used.
     */
    public $baseAssetsUrl;
    /**
     * @property string The URL of the CSS file used by this module.
     * If NULL (default) the integrated CSS file is used.
     * If === FALSE a CSS file must be explicitly included, e.g. in the layout.
     */
    public $cssFile;

    /**
     * @property boolean Set TRUE to enable development mode.
     * In development mode assets (e.g. JavaScript and CSS files) are published on
     * each access and options to initialise (if RbamModule::initialise is not
     * empty) and generate authorisation data are shown.
     */
    public $development = true;

    private $_cs;

    private $_assetsUrl;

    public function init()
    {
        //Yii::app()->theme = 'user_theme';
        if (preg_match('#LoginAD#isu', $_SERVER["REQUEST_URI"])) {
            $this->_setBaseUrl();
            $this->_publishModuleAssets();
        }
    }

    private function _setBaseUrl()
    {
        if (empty($this->baseUrl)) {
            $this->baseUrl = '';
            $m = $this;
            do {
                $this->baseUrl = '/' . $m->getId() . $this->baseUrl;
                $m = $m->getParentModule();
            } while (!is_null($m));
        }
        if (substr($this->baseUrl, -1) === '/') $this->baseUrl = substr($this->baseUrl, 0, -1);
    }

    private function _publishModuleAssets()
    {
        if (is_null($this->_cs))
            $this->_cs = Yii::app()->getClientScript();

        if (!is_string($this->baseAssetsUrl)) {
            // Republish if in development mode
            /*$this->baseAssetsUrl = ($this->development ?
                Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('Base.assets'), false, -1, true) :
                Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('BSase.assets'))
            );*/

        }

        //$this->_cs->registerScriptFile($this->assetsUrl . '/select2/select2.min.js', CClientScript::POS_BEGIN);
        //$this->_cs->registerCssFile($this->assetsUrl . '/select2/select2.css');
    }

    public function beforeControllerAction($controller, $action)
    {

        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here

            if (Yii::app()->user->isGuest && !in_array(Yii::app()->request->pathinfo, array('User/site/login', 'User/default/installation', 'User/site/recoveryPassword', 'User/site/register', 'User/profile/create'))) {
                Yii::app()->user->loginRequired();
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(__DIR__ . DIRECTORY_SEPARATOR . 'assets');
        return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files.
     */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl = $value;
    }


}
