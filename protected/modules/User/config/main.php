<?php
$moduleName = basename(dirname(dirname(__FILE__)));
$umodule = strtolower(AP_YII_UMODULE);
$tablePrefix = $umodule == 'user' ? 'adm' : 'cli';
$loginMethods = [
    1 => 'Data Base Login',
    3 => 'Certificate Login',
    4 => 'MPass Login'
];
if ($umodule == 'user')
    $loginMethods[2] = 'Active Directory Login';

return array(
    'import' => array(
        'application.modules.' . $moduleName . '.*',
        'application.modules.' . $moduleName . '.models.*',
        'application.modules.' . $moduleName . '.only-' . $umodule . '-models.*',
        //'application.modules.' . $moduleName . '.only-client-models.Client.php',

        'application.modules.' . $moduleName . '.components.*',

    ),
    'modules' => array(
        $moduleName => array(
            'class' => 'application.modules.' . $moduleName . '.UserModule',


            /**
             * the following are available login methods
             */
            'loginMethods' => $loginMethods,
            'tablePrefix' => $tablePrefix,
            'front_tiles' => array(
                'icon' => 'group',
                'color' => 'grape',
            )
        ),
    ),
    'components' => array(

        'user' => array(
            'class' => 'application.modules.' . $moduleName . '.components.WebUser',
            'loginUrl' => array('/User/site/login'),
        ),

        /*'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'ong.authitem',
            'itemChildTable'=>'ong.authitemchild',
            'assignmentTable'=>'ong.authassignment',
        ),*/
    ),
);
