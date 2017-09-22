<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 9/30/14
 * Time: 4:48 PM
 */
$module_name = basename(dirname(dirname(__FILE__)));
$module_tree = 'User.modules.LoginDB';
return array(
    'import' => array(
        'application.modules..*',
        'application.modules.' . $module_tree . '.models.*',
        'application.modules.' . $module_tree . '.controllers.*',
        'application.modules.' . $module_tree . '.views.*',
        'application.modules.' . $module_tree . '.helpers.*',
        'application.modules.' . $module_tree . '.components.*',
    ),

    'modules' => array(
        'User' => array(

            'modules' => array(
                $module_name => array(),
            ),

        ),
    ),

    'components' => array(

        'urlManager' => array(
            'rules' => array(),
        ),
    ),
);
?>