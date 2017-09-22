<?php
$module_name = basename(dirname(dirname(__FILE__)));
$module_tree = 'User.modules.Rbam';
return array(
    'sourceLanguage' => 'en_us',
    'language' => 'en',
    'timeZone' => 'Europe/Chisinau',
    'import' => array(

        'application.modules.' . $module_tree . '.models.*',
        'application.modules.' . $module_tree . '.components.*',
        'application.modules.' . $module_tree . '.components.behaviors.*',
        'application.modules.' . $module_tree . '.controllers.*',
    ),

    'modules' => array(
        'User' => array(
            'modules' => array(
                $module_name => array(
                    'applicationLayout' => 'application.views.layouts.maintheme',
                    //'applicationLayout'=>'webroot.themes.user_theme.views.layouts.main',
                    'authAssignmentsManagerRole' => 'Auth Assignments Manager',
                    'authenticatedRole' => 'Authenticated',
                    'authItemsManagerRole' => 'Auth Items Manager',
                    'baseScriptUrl' => null,
                    'baseUrl' => null,
                    'cssFile' => null,
                    'development' => true,
                    'exclude' => 'gii',
                    'guestRole' => 'Guest',
                    'initialise' => false,
                    //'layout'=>'application.views.layouts.main';//'rbam.views.layouts.main',
                    'juiCssFile' => 'jquery-ui.css',
                    'juiHide' => 'puff',
                    'juiScriptFile' => 'jquery-ui.min.js',
                    'juiScriptUrl' => null,
                    'juiShow' => 'true',
                    'juiTheme' => 'base',
                    'juiThemeUrl' => null,
                    'pageSize' => 10,
                    'rbacManagerRole' => 'RBAC Manager',
                    'relationshipsPageSize' => 10,
                    'showConfirmation' => 30,
                    'showMenu' => true,
                    'userClass' => 'User',
                    'userCriteria' => array(),
                    'userIdAttribute' => 'id',
                    'userNameAttribute' => 'username',
                ),),),
    ),

    'components' => array(
        /*'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),*/
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'assignmentTable' => 'authassignment',
        ),
    ),
);
?>
