<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="loading-indicator">
    <div id="fountainTextG">
        <div id="fountainTextG_1" class="fountainTextG">S</div>
        <div id="fountainTextG_2" class="fountainTextG">y</div>
        <div id="fountainTextG_3" class="fountainTextG">n</div>
        <div id="fountainTextG_4" class="fountainTextG">a</div>
        <div id="fountainTextG_5" class="fountainTextG">p</div>
        <div id="fountainTextG_6" class="fountainTextG">s</div>
        <div id="fountainTextG_7" class="fountainTextG">y</div>
        <div id="fountainTextG_8" class="fountainTextG">s</div>
    </div>
</div>
<?php
    if (isset(Yii::app()->modules['User']))
        $logoff = [
            'class' => 'ChangePassword.components.wid_buttons',
            //'htmlOptions'=>array('class'=>'pull-right','style'=>'cursor: pointer;padding: 5px 0;'),
            'button_array' => [
                [
                    'icon' => 'cog',
                    "title" => Yii::t('menu', 'logout'),
                    "url" => $this->createUrl('site/logout'),
                ],],
            "visible" => !Yii::app()->user->isGuest,
        ];
    else
        $logoff = [
            'class' => 'bootstrap.widgets.BsNav',
            'htmlOptions' => ['class' => 'pull-right', 'style' => 'cursor: pointer;padding: 5px 0;', 'id' => 'logoff_standard'],
            'items' => [
                [
                    'label' => Yii::t('mod_menu', 'logout'),
                    'url' => ['/site/logout'],
                    'icon' => 'off',
                    'visible' => !Yii::app()->user->isGuest],
            ]
        ];
?>

<div>
    <?php $this->widget('bootstrap.widgets.BsNavbar', [
        //'type'=>null, // null or 'inverse'
        //'brand'=>  CHtml::encode(Yii::app()->name),

        'brandUrl' => Yii::app()->baseUrl,
        //'fluid' => true,
        'collapse' => false, // requires bootstrap-responsive.css
        'id' => '',
        'items' => [
            [
                'class' => 'bootstrap.widgets.BsNav',
                'htmlOptions' => ['class' => 'pull-left', 'id' => 'dsa', 'style' => 'cursor: pointer;padding: 5px 0;'],
                'items' => [
                    ['label' => 'Modules administration',
                        'htmlOptions' => ['id' => 'asd'],
                        'items' =>
                            ModulesData::getModuleAdministration()
                    ]
                ]],
            [
                'class' => 'bootstrap.widgets.BsNav',
                'id' => '',
                'htmlOptions' => ['class' => 'pull-left', 'style' => 'cursor: pointer;padding: 5px 0;'],
                'items' => [
                    ['label' => 'Module manager',
                        'url' => ['/modulesData/admin'],
                        'visible' => !Yii::app()->user->isGuest,
                    ],

                ]],
            [
                'class' => 'bootstrap.widgets.BsNav',
                'htmlOptions' => ['class' => 'pull-right', 'style' => 'cursor: pointer;padding: 5px 0;'],
                'items' => [
                    [
                        'label' => 'Folder Tree',
                        'url' => ['/tree/index'],
                        'visible' => !Yii::app()->user->isGuest],
                ]
            ],
            $logoff,


            //Language $this->widget('application.components.widgets.LangSelector');
            [
                'class' => 'application.components.widgets.LangSelector',
                'htmlOptions' => ['class' => 'pull-right', 'style' => 'margin: 5px;'],
                'id' => '',
            ],

        ]]);
    ?>

    <?php /* $this->widget('InterfacesWidget.components.viewfolder_widgets.TreeFolder'); */ ?>
</div>
<?php if (isset($this->breadcrumbs)): ?>
    <?php $this->widget('bootstrap.widgets.BsBreadcrumbs', [
        'links' => $this->breadcrumbs,
        'htmlOptions' => ['class' => 'container'],
    ]); ?><!-- breadcrumbs -->
<?php endif ?>
<div class="container panel panel-default " id="page">
    <?php
    if (isset(Yii::app()->modules['ChangePassword'])) {
        $this->widget('ChangePassword.components.wid_popup');
    } ?>
    <?php
    /* $this->widget('InterfacesWidget.components.interfaces_widgets.UserMonitoring',
            array('title'=>'Utilizatori in sistem')); */
    ?>
    <?php echo $content; ?>

    <div class="clear"></div>


</div><!-- page -->
<div class="navbar navbar-bottom">
    <div class="container">
        <p>@ Sinapsys 2013</p>
    </div>
</div>
<script>
    $(document).ajaxSend(function (event, request, settings) {
        $('#loading-indicator').show();
    });

    $(document).ajaxComplete(function (event, request, settings) {
        $('#loading-indicator').hide();
    });
    $('.portlet').each(function () {
        var parent = $(this).parent();
        var elem = '<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: initial; padding-top: 0; margin-top: 10px; width: 100%;">';
        elem += '<li class="title" style="background-color: #c3d9ff; border-bottom: 2px solid #dddddd; padding: 5px 0; border-top-right-radius:5px; border-top-left-radius:5px;"><a style="font-weight: bold; color:#428bca;">' + $(this).find('.portlet-title').text() + '</a></li>';
        elem += '<li class="divider"></li>';
        elem += $(this).find('ul.operations').html();
        elem += '</ul>';
        $('#sidebar').append(elem);
        //parent.css('float','right');
        $(this).remove();
    });
</script>
<style>
    .dropdown-menu {
        border: 1px solid #ccc;
        /*noinspection CssOverwrittenProperties*/
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
    }

    .dropdown-menu li a {
        white-space: initial !important;
    }

    .dropdown-menu li.title a:hover {
        background-color: #c3d9ff !important;
        background-image: none;
    }
</style>
</body>
</html>
