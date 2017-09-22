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
class HelperScanModules
{


    public static function analyseModule($module)
    {
        $_module = new stdClass();
        $_module->id = ucfirst($module->getId());
        $_module->controllers = self::getControllers($module);
        //die(var_dump(get_class($module)));
        $_module->modulesData = self::getModulesData($module);
        return $_module;
    }

    private static function getControllers($module)
    {
        $controllers = array();
        $path = $module->getControllerPath();
        if (is_dir($path)) {
            foreach (scandir($path) as $controller) {
                if (self::isController($controller)) {
                    $id = str_ireplace('controller.php', '', $controller);
                    $controllers[] = (object)array(
                        'id' => $id,
                        'actions' => self::getActions($id, $path)
                    );
                }
            }
        }
        return $controllers;
    }

    /**
     * Used filter an array of files & directories for controllers
     * @param string filename
     */
    private static function isController($a)
    {
        return stripos($a, 'Controller.php') !== false;
    }

    private static function getActions($controller, $path)
    {
        $controller .= 'Controller.php';
        $actions = array();
        //die(var_dump($controller));
        if (file_exists($path . DIRECTORY_SEPARATOR . $controller)) {
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
                        $actions[] = (object)array('id' => ucfirst($class[2]));
                } else
                    $actions[] = (object)array('id' => ucfirst($match[2]));
            }//foreach
        }//file_exists
        return $actions;
    }

    /**
     * Returns an array of modulesData within the specified module
     * @param CModule the module to analyse
     * @return array modulesData
     */
    private static function getModulesData($module)
    {
        $modulesData = array();

        foreach ($module->getModules() as $id => $configuration) {
//			if (in_array($id,$this->exclude))
//				continue;
            $_module = $module->getModule($id);
            if ($_module)
                $modulesData[] = self::analyseModule($_module);
        }

        return $modulesData;
    }
}

?>
