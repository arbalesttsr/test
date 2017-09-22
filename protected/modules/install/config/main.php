<?php
$module_name = basename(dirname(dirname(__FILE__)));


return array(
    'import' => array(
        'application.modules.' . $module_name . '.*',
        'application.modules.' . $module_name . 'messages.en.*',
        'application.modules.' . $module_name . 'messages.ro.*',
        'application.modules.' . $module_name . 'messages.ru.*',
        'application.modules.' . $module_name . '.models.*',
        'application.modules.' . $module_name . '.controllers.*',
        'application.modules.' . $module_name . '.views.*',
        'application.modules.' . $module_name . '.helpers.*',
        'application.modules.' . $module_name . '.components.*',
    ),

    'modules' => array(
        $module_name => array(),
    ),

    'components' => array(
        'urlManager' => array(
            'rules' => array(),
        ),
    ),
);
?>
