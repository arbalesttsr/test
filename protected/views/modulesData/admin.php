<?php
/* @var $this ModulesDataController */
/* @var $model ModulesData */

$this->breadcrumbs = [
    'Manage Modules',
];

$this->menu = [
    //array('label'=>'List ModulesData', 'url'=>array('index')),
    //array('label'=>'Create ModulesData', 'url'=>array('create')),
    //array('label'=>'Generare', 'icon'=>'refresh', 'url'=>array('generate')),
    ['label' => 'Generare Diferential', 'icon' => 'repeat', 'url' => ['generateDiff']],
    ['label' => 'Setare dependente Module', 'icon' => 'retweet', 'url' => ['/ModulesDependence/Config']],
    ['label' => 'Exceptii Logare', 'icon' => 'unlock', 'url' => ['/loginException/admin']],
    ['label' => 'Actualizari BD', 'icon' => 'puzzle-piece', 'url' => ['/dbUpdates/admin']],
    ['label' => 'Erori Predefinite', 'icon' => 'bolt', 'url' => ['/defaultErrors/admin']],
    ['label' => 'Configuratii Sistem', 'icon' => 'cog', 'url' => ['/baseConfigs/admin']],
    ['label' => 'Formate de fisiere', 'icon' => 'magic', 'url' => ['/fileFormat/admin']],
    ['label' => 'Directorii de stocare', 'icon' => 'folder-open', 'url' => ['/storage/admin']],
    ['label' => 'Lista modificarilor efectuate', 'icon' => 'cog', 'url' => ['logFile']],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#modulesData-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
    <h1>Manage ModulesData</h1>
</div>

<?php /*echo CHtml::link('Căutare avansată','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */ ?>

<?php //$this->widget('bootstrap.widgets.BsGridView', array(?>
<?php $this->widget('application.components.widgets.usertheme.AvantGridViewModules', [
    'id' => 'modulesData-grid',
    'dataProvider' => $model->search(),
    'hide_per_page' => true,
    'afterAjaxUpdate' => "function(){replace_checkboxes_with_toggles()}",
    'filter' => $model,
    'hide_btns' => true,
    'columns' => [
        'id',
        'name' => ['name' => 'name', 'htmlOptions' => ['class' => 'module-name', 'module-id' => '']],
        //'activ',
        [
            'name' => 'activ',
            'type' => 'raw',
            'value' => function ($data) {
                $checkbox_opts = ["data-name-mod" => $data->name,
                    "data-id-mod" => $data->id,
                    "class" => "check_mod_activ"
                ];
                if ($data->activ)
                    $checkbox_opts['checked'] = true;

                return CHtml::checkBox(
                    "activ", $data->activ,
                    $checkbox_opts
                );
                return $data->activ;
            },
            'htmlOptions' => ['class' => 'toggle-button-activity active-module'],
        ],
        //'activ'=>array('name'=>'activ', 'type'=>'raw', 'value'=>'CHtml::checkBox("activ",$data->activ,array("name_mod"=>$data->name,"id_mod"=>$data->id,"class"=>"check_mod_activ"))', 'htmlOptions' => array('class'=>'toggle-button-activity active-module')),
        //'dump_restore'=>array('name'=>'dump_restore', 'type'=>'raw', 'value'=>'$data->dump_restore != 9 ? CHtml::checkBox("dump_restore",$data->dump_restore,array("name_mod"=>$data->name,"id_mod"=>$data->id,"class"=>"check_mod_dump_restore")) : ""', 'htmlOptions' => array('class'=>'toggle-button-restore')),

        [
            'name' => 'dump_restore',
            'type' => 'raw',
            'value' => function ($data) {

                if ($data->activ == 0)
                    return CHtml::link('Module Inactive', '#', ['disabled' => true, 'class' => 'btn btn-default-alt btn-xs']);

                if ($data->dump_restore == 9)
                    return CHtml::link('No tables', '#', ['disabled' => true, 'class' => 'btn btn-default-alt btn-xs']);

                $checkbox_opts = ["data-name-mod" => $data->name,
                    "data-id-mod" => $data->id,
                    "class" => "check_mod_dump_restore"
                ];

                if ($data->dump_restore == 1)
                    $checkbox_opts['checked'] = true;

                return CHtml::checkBox(
                    "dump_restore", $data->dump_restore,
                    $checkbox_opts
                );
            },
            'htmlOptions' => ['class' => 'toggle-button-restore active-module'],
        ],
        [
            'name' => 'create_user_id',
            'type' => 'raw',
            'value' => '$data->create_user_id0->username',
        ],
        'create_datetime',
        [
            'name' => 'update_user_id',
            'type' => 'raw',
            'value' => 'isset($data->update_user_id0->username)?$data->update_user_id0->username:"Nu e setat"',
        ],
        'update_datetime',
        //array(
        //	'class'=>'bootstrap.widgets.BsButtonColumn',
        //),
        [
            'class' => 'CButtonColumn',
            //'template'=>'{view}{update}{delete}{documentation}',
            'template' => '{delete}{administration}{documentation}',
            'buttons' => [
                'delete' => [
                    'options' => ['class' => "btn-action glyphicons remove_2 btn-danger", 'title' => 'Ştergere'],
                    'label' => '<i></i>',
                ],
                'administration' => [
                    'url' => 'Yii::app()->createUrl("/$data->name/default/administration")',
                    'options' => ['class' => "fa fa-arrow-right", 'title' => 'Actualizare'],
                    'label' => '<i></i>',
                    'visible' => '$data->activ'
                ],
                'documentation' => [
                    'url' => 'Yii::app()->createUrl("/ModulesData/getDocumentation", array("moduleName"=>$data->name))',
                    'options' => ['class' => "fa fa-book", 'title' => 'Documentaţie', 'target' => '_BLANK'],
                    'label' => '<i></i>',
                    'visible' => '$data->activ'
                ],
            ]
        ],
    ],]); ?>
<?php
$dependences = ModulesDependence::model()->findAll();
if (!empty($dependences)) {
    echo '<script>';
    foreach ($dependences as $dependence) {
        $module_parent = ModulesData::model()->findByPk($dependence->module_parent);
        if (!$module_parent->activ) {
            $module_children = ModulesData::model()->findByPk($dependence->module_children);
            //echo "$('td.module-name:contains(\"".$module_children->name."\")').next().hide().next().hide().after('<td colspan=\"2\">Activati intii modulul ".$module_parent->name."</td>');";
            echo "$('td.module-name:contains(\"" . $module_children->name . "\")').next().html($('<a href=\"#\" disabled class=\"btn btn-default-alt btn-xs\">Modulul " . $module_parent->name . " este inactiv</a>'));";
        }
    }
    echo '</script>';
}
?>


<?php Yii::app()->clientScript->registerScript('replace-activity-checkboxes-with-toggles',
    'function replace_checkboxes_with_toggles(){
    $("td.toggle-button-activity").each(function(){
        var td = $(this);
        if($(td.find("input[type=\'checkbox\']")).length){
            var checkbox = $(td.find("input[type=\'checkbox\']"));

            var div = $("<div></div>").addClass("toggle");

            div.click(function(){checkbox.change()});

            td.append(div.toggles({checkbox:checkbox.hide(), on:checkbox.is(":checked"), drag: false}));
        }

    });

    $("td.toggle-button-restore").each(function(){
        var td = $(this);
        //var is_active_module = $(this).parents("tr").find("td.toggle-button-activity input:checkbox").prop("checked");

        if($(td.find("input[type=\'checkbox\']")).length){
            var checkbox = $(td.find("input[type=\'checkbox\']"));

            checkbox.attr("value", checkbox.is(":checked") ? "1" : "0");

            var div = $("<div></div>").addClass("toggle");
            if(td.hasClass("toggle-button-restore"))
                div.addClass("toggle-danger");

            div.click(function(){checkbox.change()});

            td.append(div.toggles({checkbox:checkbox.hide(), on:checkbox.is(":checked"), drag: false}));
            //break;
        }

    });
}

$(document).on("change", ".check_mod_activ", function(){
    var checkbox = $(this);
    var mod_nm = checkbox.data("name-mod");
    var mod_id = checkbox.data("id-mod");
    var value = checkbox.is(":checked") ? 0 : 1;
    $.ajax({
        type: "POST",
        url: "' . Yii::app()->createUrl('/modulesData/setModuleActivity') . '",
        data: { modul_id: mod_id, value: value }
    }).success(function( msg ) {
        msg_notify("bottomLeft", "primary", 2000, msg);
        if(mod_nm != "DynamicMenu")
        {
            setTimeout(function(){location.reload(true)},750);
        }
    })
    .error(function(){
        msg_notify("bottomLeft", "error", 3000, "Something goes wrong");
    });
});

$(".check_mod_dump_restore").change(function(){
    var checkbox = $(this);
    var mod_id = checkbox.data("id-mod");
    var is_activ_ch = checkbox.parents("td").prev().find("input[type=\'checkbox\']");
    var confirmed = false;
    var call_ajax = false;
    var value = checkbox.is(":checked") ? 0 : 1;
    if(value)
    {
        if(!is_activ_ch.is(":checked"))
        {
            checkbox.prop("checked", false);
            msg_notify("bottomLeft", "primary", 2000, "Intii activati modulul");
        } else {
            call_ajax = true;
        }
    } else {
        confirmed = confirm("Sunteti sigur ca doriti sa dezactivati tabele? La urmatoarea activare toate datele vor fi sterse!!!");
        if(confirmed)
            call_ajax = true;
        else
            location.reload(false);
    }

    if(call_ajax)
    {
        $.ajax({
            type: "POST",
            url: "' . Yii::app()->createUrl('/modulesData/setDumpRestore') . '",
            data: { modul_id: mod_id, value: value }
        }).success(function( msg ) {
            msg_notify("bottomLeft", "primary", 2000, msg);
        }).error(function(){
            msg_notify("bottomLeft", "error", 3000, "Something goes wrong, or this module hasn\'t backup file");
        });
    }
});

', CClientScript::POS_END); ?>


<?php Yii::app()->clientScript->registerCss('toggle-allign-center', '
    div.toggle{margin: 0 auto;}
    td.toggle-button-activity, td.toggle-button-restore{text-align: center;}
    div.toggle-button span.labelRight{width: 56px}
'); ?>
<script>


    $(document).ready(function () {
        //first call
        replace_checkboxes_with_toggles();

    });

    /*$(window).load(function(){
     $('div.toggle-button span.labelRight').css('width','55px');
     $('div.toggle-button label[for="activ"]').css('width','53px');
     });*/
</script>
