<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
const ERR_WITHOUT_PARAMS = '1';
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    /**
     * @var users_online returns list of online users active in last 5 minutes
     */
    public $users_online = array();

    function __construct($id, $module)
    {
        parent::__construct($id, $module);

        // If there is a post-request, redirect the application to the provided url of the selected language
        if (isset($_POST['language'])) {
            $lang = $_POST['language'];
            $MultilangReturnUrl = $_POST[$lang];
            $this->redirect($MultilangReturnUrl);
        }
        // Set the application language if provided by GET, session or cookie
        if (isset($_GET['language'])) {
            Yii::app()->language = $_GET['language'];
            Yii::app()->user->setState('language', $_GET['language']);
            $cookie = new CHttpCookie('language', $_GET['language']);
            $cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;
        } else if (Yii::app()->user->hasState('language'))
            Yii::app()->language = Yii::app()->user->getState('language');
        else if (isset(Yii::app()->request->cookies['language']))
            Yii::app()->language = Yii::app()->request->cookies['language']->value;
        else Yii::app()->language = 'ro';
    }

        public function redirect($url, $terminate = true, $statusCode = 302)
    {
        if (is_array($url)) {
            $route = isset($url[0]) ? $url[0] : '';
            $url = $this->createUrl($route, array_splice($url, 1));
        } else $url = $this->createUrl($url);
        Yii::app()->getRequest()->redirect($url, $terminate, $statusCode);
        //Yii::app()->getRequest()->redirect($this->createUrl($url),$terminate,$statusCode);
    } //daca nu transmitem parametru

    public function createMultilanguageReturnUrl($lang = 'ro')
    {
        /*if(is_array($url))
        {
            $route=isset($url[0]) ? $url[0] : '';
            $url=$this->createUrl($route,array_splice($url,1));
        } else $url=$this->createUrl($url);
        Yii::app()->getRequest()->redirect($url,$terminate,$statusCode);*/

//die(var_dump(Yii::app()->request->getUrl()));
        //if (count($_GET)>0){
        $arr = (count($_GET) > 0) ? $_GET : array();
        $arr['language'] = $lang;
        //}
        //else
        //   $arr = array('language'=>$lang);

        $url = isset($this->module) ? (DIRECTORY_SEPARATOR . $this->module->id . DIRECTORY_SEPARATOR) : '';

        $url .= $this->getId() . DIRECTORY_SEPARATOR;
        $url .= $this->getAction()->getId();

        $url = $this->createUrl($url, $arr);
        //return "/$lang/" . strtr(base64_encode(Yii::app()->getSecurityManager()->encrypt($url)), '+/=', '-_,');
		
        return $url;
        //return $this->createUrl('', $arr);
    }

    public function isActionExists($controller, $path, $action)
    {
        $controller .= 'Controller.php';

        if (!is_dir($path))
            return false;

        if (!file_exists($path . DIRECTORY_SEPARATOR . $controller))
            return false;

        $source = file_get_contents($path . DIRECTORY_SEPARATOR . $controller);
        preg_match_all('/function (?:(actions)|action(\w+))\(/i', $source, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            if (!empty($match[1])) {
                $actionsMethod = '';
                $braces = 0;
                $pos = stripos($source, 'function actions()') + strlen('function actions()');

                while (($c = $source[++$pos]) !== '{') ;
                do {
                    $c = $source[$pos++];
                    if ($c === '{')
                        $braces++;
                    elseif ($c === '}')
                        $braces--;
                    $actionsMethod .= $c;
                } while ($braces > 0);

                preg_match_all('/([\'"])(\w+)\1.*?class/si', $actionsMethod, $classes, PREG_SET_ORDER);

                foreach ($classes as $class)
                    if (strtolower(ucfirst($class[2])) === strtolower($action))
                        return true;
            } else
                if (strtolower(ucfirst($match[2])) === strtolower($action))
                    return true;
        }
        return false;
    }

    public function isControllerExists($id)
    {
        $calledClass = get_called_class();
        //$rf = new ReflectionClass($calledClass);
        //$controllerDir = dirname($rf->getFileName());
        $trace = debug_backtrace();
        $controllerDir = dirname($trace[0]['file']);
        //die(var_dump($controllerDir));
        if (!is_dir($controllerDir))
            return false;
        $controllerDir = str_replace("_backend","",Yii::app()->getModule('Clasificator')->controllerPath);
        return file_exists($controllerDir . DIRECTORY_SEPARATOR . ucfirst($id) . 'Controller.php');
    }

    protected function beforeAction($ERR_WITHOUT_PARAMS)
    {
        if (strpos(Yii::app()->request->pathinfo, '/') !== false || strlen(Yii::app()->request->pathinfo) <= 43)
            $pathinfo = Yii::app()->request->pathinfo;
        else {
            $pathinfo = Yii::app()->getSecurityManager()->decrypt(base64_decode(strtr(Yii::app()->request->pathinfo, '-_,', '+/=')));
        }
        if(isset($_GET['language']))
        {
            Yii::app()->setLanguage($_GET['language']);
            Yii::app()->user->setState('language', $_GET['language']);
            $cookie = new CHttpCookie('language', $_GET['language']);
            $cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;
        }

        //import business modules models
        if (isset(Yii::app()->modules['Business'])) {
            $imported_models = BusinessAccess::getImportedModels();
            Yii::app()->clientScript->registerScript('get-business-included', 'console.log(' . json_encode($imported_models) . ')');
            foreach ($imported_models as $imported_model)
                Yii::import($imported_model);
        }

        //if logout, delete user activity
        if (strpos(Yii::app()->getRequest()->getUrl(), '/site/logout') !== false)
            $this->deleteUserActivity();
        elseif (strpos(Yii::app()->getRequest()->getUrl(), '/User/site/login') !== false) {
        } elseif (!Yii::app()->request->isAjaxRequest)
            try{
                $this->setUserActivity();
            }catch(Exception $ex)
            {}

        //uncomment this row if all users has access to all actions
        $exceptions = LoginException::model()->findAllByAttributes(array('type' => '1'));
        foreach ($exceptions as $exception) {
            if (strtolower($exception->action) == strtolower($pathinfo)) {
                return true;
            }
        }

        $exceptions = LoginException::model()->findAllByAttributes(array('type' => '2'));
        foreach ($exceptions as $exception) {
            if (strpos(strtolower($pathinfo), strtolower($exception->action)) !== false) {
                return true;
            }
        }

        //beforeAction actions for module rbam(if it is set)
        if (isset(Yii::app()->modules['User']['modules']['Rbam'])) {     // return true;

            $module_name_rbam = '';
            if (isset($this->module)): $module_name_rbam = $this->module->getName() . ':'; endif;
            if (Yii::app()->user->checkAccess($module_name_rbam . ucfirst($this->getId()) . ':' . ucfirst($this->getAction()->getId()))) {
                return true;
            } else
                if (ucfirst($this->getId()) == 'Site')

                    return true;
                else
                    throw new CHttpException(403, 'Nu sunteti autorizat pentru a vizualiza aceasta pagina');
            //var_dump ($module_name_rbam.ucfirst($this->getId()) .':'. ucfirst($this->getAction()->getId()));
        } else
            return true;
    }

    private function deleteUserActivity()
    {
        $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
        if (isset(Yii::app()->user->id)) {
            //die('asd');
            $user_id = Yii::app()->user->id;

            //TODO: Don't do this every time the app runs??

            $sql = "DELETE FROM {$visitorTableName} WHERE user_id=:user_id";
            try{
                Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->execute();
            }
            catch(Exception $ex){}
        }
    }

    private function setUserActivity()
    {
        $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
        if (isset(Yii::app()->user->id)) {
            //die('asd');
            $user_id = Yii::app()->user->id;

            //TODO: Don't do this every time the app runs??

            $arr = (count($_GET) > 0) ? $_GET : array();

            $url = isset($this->module) ? (DIRECTORY_SEPARATOR . $this->module->getName()) : '';
            $url .= DIRECTORY_SEPARATOR . $this->getId();
            $url .= DIRECTORY_SEPARATOR . $this->getAction()->getId();
            $lasturl = $url . ((count($_GET) > 0) ? ('?' . http_build_query($_GET)) : '');

            if (strpos($lasturl, 'logout') == false) {
                $sql = "SELECT user_id FROM {$visitorTableName} WHERE user_id=:user_id";
                try {
                    $exist_last_activity = Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->queryScalar();
                }catch(Exception $ex)
                {
                    $exist_last_activity = false;
                }
                    if ($exist_last_activity === false)
                        $sql = "INSERT INTO {$visitorTableName} (user_id, last_activity, last_url) VALUES (:user_id, :last_activity, :last_url)";
                    else
                        $sql = "UPDATE {$visitorTableName} SET last_activity=:last_activity, last_url=:last_url WHERE user_id=:user_id";
                if(!is_null(User::model()->findByPk(Yii::app()->user->id)))
                    Yii::app()->db->createCommand($sql)->bindValue(':user_id', $user_id)->bindValue(':last_activity', date('Y-m-d H:i:s'))->bindValue(':last_url', $lasturl)->execute();
            }
        }
    }

}
