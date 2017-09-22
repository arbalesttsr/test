<?php //Yii::import('application.modules.Documents.controllers.DefaultController');
//$dtController = new DefaultController; ?>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/scripts/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css'); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/plupload.full.js'),CClientScript::POS_END); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js'), CClientScript::POS_END); ?>
<?php //$lang = Yii::app()->language; ?>
<?php //if (file_exists(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/'.$lang.'.js')) {
//Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/'.$lang.'.js'),CClientScript::POS_END);
//}
?>
<?php $uniq_id = md5($modelName . $modelAttr . $attrName . time() . rand() . rand());
$cl_modal_id = 'cl-attach-document-modal-' . $uniq_id;
$input_id = 'cls-' . $uniq_id;
$cl_show_id = 'cl-show-modal-create-cls-' . $uniq_id;
$dependent_search_data = $this->dependsAttribute ? (', dependencyValue: $("input[name=\'' . CHtml::activeName($model, $this->dependsAttribute) . '\']").val(), dependencyAttr: "' . $this->dependsRemoteAttribute . '"') : '';
?>

<?php $is_disabled = false;
$clasificator_title = ''; ?>
<?php if (isset($model->$attrName) && is_numeric($model->$attrName)) {
    $is_disabled = true;
    $clasificator_title = $modelName::model()->findByPk($model->$attrName)->$modelAttr;
} ?>
<?php /*if($createNew && $selectExistent){ ?>
    <a href="#<?php echo $cl_modal_id; ?>" data-toggle="modal" class="btn-action glyphicons circle_plus btn-info create-new-cls" style="position: absolute; left: 12%;" title="Adaugare <?=$modelName;?>"><i></i></a>
<?php } elseif($createNew){ ?>
    <a class="btn btn-primary btn-icon glyphicons file <?=$cl_show_id;?>" href="#<?php echo $cl_modal_id; ?>" data-toggle="modal"><i></i>Creati <?=$modelName;?></a>
<?php }*/ ?>
<?php echo CHtml::activeHiddenField($model, $attrName, array('id' => $input_id));//elementul care pastreaza id-ul documentului in forma ?>
<?php if ($selectExistent && $createNew) { ?>
    <div class="col-sm-6"><div class="input-group">
<?php } /* ?>
    <input type="text" class="form-control">
    <div class="input-group-btn">
        <a type="button" class="btn btn-info"><i class="fa fa-plus-circle"></i></a>
    </div>
<?php */
if ($selectExistent) {
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name' => 'searchbox_' . $uniq_id,
        'value' => $clasificator_title,
        //'source'=>$this->createUrl('getDestinations'),
        'source' => 'js: function(request, response) {
            $.ajax({
                url: "' . Yii::app()->createUrl('/Clasificator/default/getClasificatorByOneAttr') . '",
                dataType: "json",
                data: {
                    term: request.term,
                    modelName: "' . $modelName . '",
                    modelAttr: "' . $modelAttr . '"' . $dependent_search_data . '
                },
                success: function (data) {
                        response(data);
                }
            })
        }',
        'options' => array(
            'showAnim' => 'fold',
            'autoFill' => false,
            'select' => 'js:function( event, ui ) {
                $("#searchbox_' . $uniq_id . '").val( ui.item.label );
                $("#' . $input_id . '").val( ui.item.value );
                return false;
            }',
            'focus' => 'js:function (event, ui) {
                $("#searchbox_' . $uniq_id . '").val( ui.item.label );
                $("#' . $input_id . '").val( ui.item.value );
                return false;
            }'
        ),
        'htmlOptions' => array(
            'style' => '-webkit-box-sizing: border-box!important; -moz-box-sizing: border-box!important; box-sizing: border-box!important;',
            'onkeydown' => 'js: if(this.value == "") $("#' . $input_id . '").val("");',
            'onblur' => 'js: if(this.value == "") $("#' . $input_id . '").val("");',
            'class' => 'form-control',
            'placeholder' => Yii::t('ClasificatorModule.clasificator', 'Write for search').' '.Yii::t('ClasificatorModule.model', $modelName),
        ),
    ));
}
if ($createNew && $selectExistent) { ?>
    <div class="input-group-btn" style="z-index: 99;">
        <a href="#<?php echo $cl_modal_id; ?>" data-toggle="modal" type="button" class="btn btn-primary"><i
                class="fa fa-plus-circle"></i></a>
    </div>
<?php } elseif ($createNew && !$selectExistent) { ?>
    <a href="#<?php echo $cl_modal_id; ?>" data-toggle="modal" class="btn btn-primary btn-label"><i
            class="fa fa-plus-circle"></i>Creati <?= $modelName; ?></a>
<?php }
if ($createNew) {
    $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => $cl_modal_id)); //primul modal in care se afla dt-ul ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 style="margin:0; font-weight: normal;"><?= Yii::t('ClasificatorModule.clasificator', 'Create').' '.Yii::t('ClasificatorModule.model', $modelName);?></h5>
    </div>
    <div class="modal-body">
        <div class="form form-<?= $uniq_id; ?>">
            <?php echo CHtml::hiddenField('modelName', $modelName); ?>
            <?php echo CHtml::hiddenField('modelAttr', $modelAttr); ?>
            <div class="rows_reponse_<?= $uniq_id; ?>"></div>
            <?php //$clsModule = Yii::app()->getModule('Clasificator'); ?>
            <?php //Yii::app()->runController("Clasificator/adminCl/getAllFormInputs/modelName/$modelName"); ?>
            <?php //Yii::app()->runController(Yii::app()->createUrl('Clasificator/adminCl/getAllFormInputs', array('modelName' => $modelName))); ?>
            <?php echo CHtml::ajaxSubmitButton(
                'Creare',
                CHtml::normalizeUrl(array('/Clasificator/adminCl/validateRemoteCl')),
                array('success' => 'function(data){
                                var response = jQuery.parseJSON(data);
                                if(!response.state){
                                    //console.log(response.msg);
                                    $("form.form-' . $uniq_id . '").find("div.alert").remove();
                                    var divAlert = $("<div></div>");
                                    divAlert.addClass("alert alert-danger");
                                    $("form.form-' . $uniq_id . '").prepend(divAlert.html($(response.msg)));
                                } else {
                                    $("#' . $input_id . '").val(response.id);
                                    $("#searchbox_' . $uniq_id . '").val( response.title );
                                    $(".' . $cl_show_id . '").attr("disabled", "disabled").removeClass("btn-primary").addClass("btn-success ok_2");
                                    //if(!$(".' . $input_id . '").parent().find(".success-created").length) $(".' . $input_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                    $("#' . $cl_modal_id . '").modal("hide");
                                }
                                //console.log(data)
                            }',
                    //'update'=>'#myDiv'
                ),
                array('name' => 'create-doc-' . $uniq_id, 'class' => 'btn btn-success')
            ); ?>
            <div style="clear: both"></div><?php ?>
            <?php //echo CHtml::endForm(); ?>
        </div>
        <?php //die(); ?>


    </div>
    <?php $this->endWidget(); ?>
    <?php Yii::app()->clientScript->registerScript('get-content-form-inputs-' . $uniq_id, '
        $("#' . $cl_modal_id . '").on("shown.bs.modal", function() {
            $.get("' . Yii::app()->createUrl('Clasificator/adminCl/getAllFormInputs', array('modelName' => $modelName)) . '",
                function( data ) {
                    $(".rows_reponse_' . $uniq_id . '").html($(data));
                    reDrawPageElements();
            });
        });', CClientScript::POS_READY); ?>

    <?php Yii::app()->clientScript->registerCss('modals-styles' . $uniq_id,
        '#' . $cl_modal_id . '{z-index:8888}
            a.create-new-cls {width: 35px!important; height: 35px!important;}
            a.create-new-cls i:before {font-size: 23px!important;}'
    ); ?>

    <?php Yii::app()->clientScript->registerScript('tabs-upload-doc-' . $uniq_id, '$(".tabs-doc-' . $uniq_id . ' .widget-head li a:first").click();', CClientScript::POS_READY); ?>

    <?php Yii::app()->clientScript->registerScript('tabs-upload-doc-' . $uniq_id,
        '$(".tabs-doc-' . $uniq_id . ' .widget-head li a").click(function(){
                var id = $(this).attr("href");
                $(".tabs-doc-' . $uniq_id . ' .tab-pane").hide();
                $(".tabs-doc-' . $uniq_id . ' .tab-pane" + id).show();
            });', CClientScript::POS_END); ?>

    <?php Yii::app()->clientScript->registerScript('asdasdasdas-' . $uniq_id,
        'if($("div.form-' . $uniq_id . '").find("form").length == 0){
                var form = $("<form></form>");
                form.addClass("form-' . $uniq_id . '");
                form.attr("method", "post");
                form.html($("div.form-' . $uniq_id . '").html());
                $("div.form-' . $uniq_id . '").html(form);
                //console.log(form,$("form-' . $uniq_id . '"))
            }
            ', CClientScript::POS_END); ?>
<?php } ?>
<?php if ($selectExistent && $createNew) { ?>
    </div></div>
<?php } ?>
<?php //if create new //Yii::app()->clientScript->scriptMap['jquery.js']=false;?>
<?php //Yii::app()->clientScript->scriptMap['jquery-ui.min.js']=false;?>