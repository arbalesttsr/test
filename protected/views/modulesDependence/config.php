<?php $this->menu = [
    ['label' => 'Administrare Module', 'icon' => 'list', 'url' => ['/modulesData/admin']],
    //array('label'=>'Generare', 'icon'=>'refresh', 'url'=>array('generate')),
    ['label' => 'Generare Diferential', 'icon' => 'repeat', 'url' => ['/modulesData/generateDiff']],
];

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Manage Modules Dependence',
]; ?>


<table border="0" width="100%">
    <tr>
        <td width="49%" valign="top">
            <div class="widget widget-gray widget-gray-white margin-bottom-none pull-left" style="width: 100%">
                <div class="widget-head">
                    <h4 class="heading">Lista modulelor</h4>
                </div>
                <div class="widget-body">
                    <?php foreach ($modules as $module) { ?>
                        <div class="draggable" module_id="<?php echo $module->id; ?>">
                            <?php echo $module->name; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </td>
        <td width="2%"><span class="glyphicons no-js chevron-right"><i></i></span></td>
        <td width="49%" valign="top">
            <div class="widget widget-gray widget-gray-white margin-bottom-none pull-left" style="width: 100%">
                <div class="widget-head">
                    <h4 class="heading">Lista modulelor</h4>
                </div>
                <div class="widget-body all-dependences">
                    <?php foreach ($modules as $module) { ?>
                        <div class="dependences" module_id="<?php echo $module->id; ?>">
                            <?php echo $module->name; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </td>
    </tr>
</table>
<?php
$this->widget('application.components.widgets.usertheme.UserButton', [
    'type' => 'primary',
    //'buttonType'=>'ajaxButton',
    //'url' => Yii::app()->createAbsoluteUrl("/ModulesDependence/setDependences"),
    /*'ajaxOptions'=>array(
        'type'=>'POST',
        'data'=>'js:$("#txtname").val()',
        'success'=>'js:function(data){
            alert(data)
        }'
    ),*/
    'label' => 'Salveaza',
    //'icon'=>'user',
    'htmlOptions' =>
        [//'style'=>"margin-left: 5px;",
            'id' => 'save-dependences']
]);
?>
<?php $cs = Yii::app()->getClientScript();
foreach ($dependences as $dependence) {
    //$module_parent = ModulesData::model()->findByPk($dependence->);
    $module_children = ModulesData::model()->findByPk($dependence->module_children);
    ?>
    <script>
        var dv = '<div class="draggable ui-draggable" module_id="<?php echo $module_children->id; ?>"><?php echo $module_children->name; ?><button type="button" class="close" onclick="$(this).parent().remove()" aria-hidden="true">×</button></div>';
        $('.all-dependences .dependences[module_id="' + <?=$dependence->module_parent?> +'"]').append(dv);
    </script>
<?php } ?>
<?php
$cs->registerScript(
    'config',
    "
    $('.draggable').draggable({ helper: 'clone', opacity: 0.5, cursor: 'crosshair' });
    $('.dependences').droppable({ 
        accept: '.draggable', 
        drop: function(event, ui) {
            var clone = ui.draggable.clone( true );
            var this_mod_id = $(this).attr('module_id');
            var clone_mod_id = clone.attr('module_id');

            if(this_mod_id !== clone_mod_id && $(this).find('div[module_id=\"'+clone_mod_id+'\"]').size() === 0){
                clone.append($('<button type=\"button\" class=\"close\" onclick=\"$(this).parent().remove()\" aria-hidden=\"true\">&times;</button>'));
                $(this).append(clone);
            }
        }
    });
    $('#save-dependences').click(function(){
        //var json_dep = [];
        var count_dep = $('div.dependences div.draggable').size();
        var ajax_calls = 0;
        $.get('" . Yii::app()->createUrl('/ModulesDependence/RemoveDependences') . "', function( data ) {
            msg_notify('bottomLeft', 'primary', 2000, 'Au fost sterse ' + data + ' dependente');
        });
        $('div.dependences').each(function(){
            var dep = $(this);
            if(dep.find('div.draggable').size() > 0)
            {
                var rels = dep.find('div.draggable');
                rels.each(function(){
                    var rel = $(this);
                    //json_dep.push({'parent':dep.attr('module_id'),'children':rel.attr('module_id')});
                    //console.log(rel);
                    $.ajax({
                        type: 'post',
                        url: '" . Yii::app()->createUrl('/ModulesDependence/SetDependence') . "',
                        data: {parent: dep.attr('module_id'), children: rel.attr('module_id')},
                        success: function(data){
                            msg_notify('bottomLeft', 'primary', 2000, data);
                            ajax_calls++;
                            if(ajax_calls === count_dep){
                                msg_notify('bottomLeft', 'primary', 2000, 'All Dependences created successfully<br/>Refreshibg page...');
                                setTimeout(function(){location.reload(true)},2000);
                            }
                        },
                        //dataType: 
                    });
                })
            }
        });
        //console.dir(json_dep);
    })
    ", CClientScript::POS_READY);

$cs->registerCss(
    'config',
    "div.draggable{font-size: 13px; padding: 3px 10px; margin: 5px 0; background: #eee; cursor:pointer; -webkit-border-radius: 3px; border-radius: 3px; -webkit-box-shadow: 0 0 5px 0 #aaa; box-shadow: 0 0 5px 0 #aaa;}
    div.draggable:active{cursor:move;}
    div.dependences{font-size: 15px; padding: 3px 10px; margin: 2px 0; background: #efefef; border: 1px solid #dedede;}
    "); ?>
