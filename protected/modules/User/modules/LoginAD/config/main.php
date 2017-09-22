<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 9/30/14
 * Time: 4:34 PM
 */

$module_name = basename(dirname(dirname(__FILE__)));
$module_tree = 'User.modules.LoginAD';
return array(
    'import' => array(
        'application.modules.' . $module_tree . '.*',
        'application.modules.' . $module_tree . '.models.*',
        'application.modules.' . $module_tree . '.controllers.*',
        'application.modules.' . $module_tree . '.views.*',
        'application.modules.' . $module_tree . '.helpers.*',
        'application.modules.' . $module_tree . '.components.*',
    ),

    'modules' => array(
        'User' => array(
            'modules' => array(
                $module_name => array(


                    /**
                     * LDAP configuration
                     * To work, it requires PHP extension php_ldap. You may load it in php.ini file.
                     * @link http://www.php.net/manual/en/book.ldap.php
                     */
                    'ldap' => array(
                        'host' => '212.56.197.2',//'192.168.14.101',
                        'ou' => 'organisational-unit', // such as "people" or "users"
                        'port' => '389',
                        'dc' => array('nippon', 'local'),
                    ),
                    'front_tiles' => array(
                        'icon' => 'group',
                        'color' => 'grape',
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