<?php
/**
 * Created by PhpStorm.
 * User: tudor
 */
$module_name = basename(dirname(dirname(__FILE__)));
$module_tree = 'User.modules.LoginCTS';
return array(
    'import' => array(
        'application.modules..*',
        'application.modules.' . $module_tree . '.models.*',
        'application.modules.' . $module_tree . '.controllers.*',
        'application.modules.' . $module_tree . '.views.*',
        'application.modules.' . $module_tree . '.helpers.*',
        'application.modules.' . $module_tree . '.components.*',
        'application.modules.' . $module_tree . '.components.cts.CtsAuth',
    ),

    'modules' => array(
        'User' => array(

            'modules' => array(
                $module_name => array(
                    'cts' => array(
                        'test' => 'cts bla bla',
                    ),
                ),
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