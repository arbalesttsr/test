<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/scripts/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/plupload.full.js'), CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js'),
    CClientScript::POS_END); ?>
<?php $lang = Yii::app()->language; ?>
<?php if (file_exists(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/' . $lang . '.js')) {
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/plupload/js/' . $lang . '.js'), CClientScript::POS_END);
}
?>
<?php $uniq_id = md5($modelName . $attrName . time());
$modal_id = 'attach-document-modal-' . $uniq_id;
$uploader_id = 'uploader-' . $uniq_id;
$input_id = 'doc-' . $uniq_id;
$show_id = 'show-modal-upload-doc-' . $uniq_id;
?>
<a class="btn btn-primary btn-icon glyphicons file <?php echo $show_id; ?>" href="#<?php echo $modal_id; ?>"
   data-toggle="modal"><i></i>Incarcati fisierul</a>
<?php if (isset($model->$attrName) && (file_exists($model->$attrName) || is_numeric($model->$attrName))) { ?>
    <span class="glyphicons check success-created"><i></i></span>
<?php } ?>

<?php echo CHtml::activeHiddenField($model, $attrName, array('id' => $input_id)); ?>

<?php $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => $modal_id)); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h5 style="margin:0; font-weight: normal;">Ataseaza un document</h5>
</div>

<div class="modal-body">
    <div class="widget widget-2 widget-tabs widget-tabs-2 tabs-doc-<?php echo $uniq_id; ?>">
        <?php $useAs = $modelName::model()->useAs(); ?>
        <div class="widget-head">
            <ul style="padding-left: 0;">
                <?php if (is_array($useAs) && in_array('file', $useAs)) { ?>
                    <li><a class="glyphicons file_import" href="#upload-doc" data-toggle="tab"><i></i>Incarcati
                            fisier</a></li>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('tempate', $useAs)) { ?>
                    <li><a class="glyphicons pencil" href="#template-doc" data-toggle="tab"><i></i>Alegeti un Sablon
                            DOCX</a></li>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('tempate', $useAs)) { ?>
                    <li><a class="glyphicons pencil" href="#template-pdf" data-toggle="tab"><i></i>Alegeti un Sablon PDF</a>
                    </li>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('special', $useAs)) { ?>
                    <li><a class="glyphicons magic" href="#special-doc" data-toggle="tab"><i></i>Alegeti un Sablon</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="widget-body" style="padding: 0; overflow: hidden;">
            <?php if (is_array($useAs) && in_array('file', $useAs)) { ?>
                <div class="tab-pane active" id="upload-doc">
                    <div id="<?php echo $uploader_id; ?>" style="margin:0;">
                        <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                    </div>

                    <?php
                    $extensions = array();
                    $max_file_size = 1;
                    $dt = DocumentType::model()->findByAttributes(array('instance_model_name' => $modelName));
                    if (!is_null($dt)) {
                        $cat = DocumentCategory::model()->findByPk($dt->category_id);
                        if (!is_null($cat)) {
                            $ext_models = FileFormat::model()->findAllByPk(explode(',', $cat->extensions));
                            if (!empty($ext_models))
                                foreach ($ext_models as $ext_model)
                                    $extensions[] = $ext_model->extension;
                            $max_file_size = $cat->file_size;
                        }
                    }
                    ?>

                    <?php Yii::app()->clientScript->registerScript('files-upload-doc-' . $uniq_id, '
                                                $("#' . $uploader_id . '").pluploadQueue({
                                                    runtimes : "gears,browserplus,html5",
                                                    url : "' . Yii::app()->createUrl('/Documents/default/uploadDocumentFile/', array('state' => 'upload_wizard')) . '",
                                                    max_file_size : "' . $max_file_size . 'mb",
                                                    chunk_size : "' . $max_file_size . 'mb",
                                                    unique_names : true,

                                                    filters : [
                                                            {title : "Fisierele incarcate", extensions : "' . implode(',', $extensions) . '"}
                                                    ],

                                                    init : {
                                                        FilesAdded: function(up, files) {
                                                            checkUploadFiles' . $uniq_id . '(up.files.length, 1);
                                                        },
                                                        FilesRemoved: function(up, files) {
                                                            checkUploadFiles' . $uniq_id . '(up.files.length, 1);
                                                        }
                                                    }
                                                });

                                                var uploader = $("#' . $uploader_id . '").pluploadQueue();

                                                uploader.bind("FileUploaded", function() {
                                                    if(uploader.files.length == (uploader.total.uploaded + uploader.total.failed)) {
                                                            $.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile', array('state' => 'upload_wizard')) . '", function( data ) {
                                                                var file = data;
                                                                var instance = "' . $modelName . '";
                                                                                                                    
                                                                $.ajax({
                                                                    type: "POST",
                                                                    dataType: "JSON",
                                                                    url: "' . Yii::app()->createUrl('/Documents/default/remoteCreateDocumentAjax') . '",
                                                                    data: { file: file, instance: instance }
                                                                })
                                                                .success(function(response) {
                                                                    if(response.state){
                                                                        $("#' . $modal_id . '").modal("hide");
                                                                        $.post( "' . Yii::app()->createUrl('/Documents/default/updateDocumentTitle') . '", { id: response.document_id, title: "' . $realName . ' " + response.document_id }, function(data) {
                                                                            var response1 = $.parseJSON(data);
                                                                            var input = $("input#' . $input_id . '");
                                                                            //input.val(response.document_id).after("<i>"+"' . $realName . ' " + response.document_id+"</i>");
                                                                            //input.val(response.document_id).after("<span class=\'glyphicons check success-created\'><i></i></span>");
                                                                            if(!input.parent().find(".success-created").length) input.after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                                            //$(".' . $show_id . '").hide();
                                                                            msg_notify("bottomLeft", response1.state ? "success" : "warning", 5000, response1.msg);
                                                                        });
                                                                    }
                                                                    else
                                                                        msg_notify("bottomLeft", "error", 5000, response.msg);
                                                                });
                                                            });
                                                    }
                                                });

                                                function checkUploadFiles' . $uniq_id . '(exists, wanted_files){
                                                    if (exists != wanted_files) {
                                                        $("#' . $modal_id . ' .plupload_add").attr("style","display:block !important").show();
                                                        $("#' . $modal_id . ' .plupload_start").attr("style","display:none !important").hide();
                                                    }
                                                    if (exists > wanted_files) {
                                                        msg_notify("bottomLeft", "error", 6000, 
                                                            "' . Yii::t('DocumentsModule.t_errors', 'you_have_uploaded') . '" + " " + exists + " " +
                                                            ((exists == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'file') . '" : "' . Yii::t('DocumentsModule.t_errors', 'files') . '") +
                                                            ", " + "' . Yii::t('DocumentsModule.t_errors', 'more_than') . '" + " " + wanted_files + " " +
                                                            ((wanted_files == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'act') . '" : "' . Yii::t('DocumentsModule.t_errors', 'acts') . '") + ".<br/>" +
                                                            "' . Yii::t('DocumentsModule.t_errors', 'files_is_more') . '" + " " + (exists - wanted_files) + " " +
                                                            ((exists - wanted_files == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'file') . '" : "' . Yii::t('DocumentsModule.t_errors', 'files') . '!"));
                                                    } 
                                                    else if (exists < wanted_files) {
                                                        msg_notify("bottomLeft", "error", 6000, 
                                                            "' . Yii::t('DocumentsModule.t_errors', 'you_have_uploaded') . '" + " " + exists + " " +
                                                            ((exists == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'file') . '" : "' . Yii::t('DocumentsModule.t_errors', 'files') . '") +
                                                            ", " + "' . Yii::t('DocumentsModule.t_errors', 'less_than') . '" + " " + wanted_files + " " +
                                                            ((wanted_files == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'act') . '" : "' . Yii::t('DocumentsModule.t_errors', 'acts') . '") + ".<br/>" +
                                                            "' . Yii::t('DocumentsModule.t_errors', 'files_is_less') . '" + " " + (wanted_files - exists) + " " +
                                                            ((wanted_files - exists == 1) ? "' . Yii::t('DocumentsModule.t_errors', 'file') . '" : "' . Yii::t('DocumentsModule.t_errors', 'files') . '!"));
                                                    }  
                                                    else {
                                                        $("#' . $modal_id . ' .plupload_add").attr("style","display:none !important").hide();
                                                        $("#' . $modal_id . ' .plupload_start").attr("style","display:block !important").show();
                                                    }
                                                }
                                        ', CClientScript::POS_END); ?>
                    <?php Yii::app()->clientScript->registerCss('files-upload-css', '.plupload_filelist_footer{height:38px!important;} .plupload_start{display:none!important;}'); ?>
                </div>
            <?php } ?>
            <?php if (is_array($useAs) && in_array('tempate', $useAs)) { ?>
                <div class="tab-pane active" id="template-doc">
                    <div style="margin: 10px;">
                        <?php $dt = DocumentType::model()->findByAttributes(array('instance_model_name' => $modelName));
                        $dt_templates = DocumentsTypesTemplatesLink::model()->findAllByAttributes(array('type_id' => $dt->id)); //die(var_dump($dt_templates));
                        if (empty($dt_templates))
                            echo 'Din pacate nu a fost setat nici un sablon pentru acest tip de document. <a href="' . Yii::app()->createUrl('/Documents/template/admin') . '">Setati un sablon</a>';
                        else {
                            $in = array();
                            foreach ($dt_templates as $dt_template)
                                $in[] = $dt_template->template_id;
                            echo CHtml::dropDownList('template_id', '', CHtml::listData(DocumentsTemplates::model()->findAllByPk($in), 'id', 'name'));
                            echo CHtml::button('Creati documentul', array('id' => 'choose-template-' . $uniq_id, 'class' => 'btn btn-success pull-right', 'style' => 'margin:10px 0;'));
                        } ?>
                    </div>
                    <?php Yii::app()->clientScript->registerScript('files-template-doc-' . $uniq_id, '
                                                $("#choose-template-' . $uniq_id . '").click(function(){
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "' . Yii::app()->createUrl('/Documents/default/uploadTemplateFile', array('state' => 'upload_wizard')) . '",
                                                        data: { template_id: $("#template_id").val() }
                                                    })
                                                    .success(function() {
                                                            $.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile', array('state' => 'upload_wizard')) . '", function( data ) {
                                                                var file = data;
                                                                var instance = "' . $modelName . '";
                                                                                                                    
                                                                $.ajax({
                                                                    type: "POST",
                                                                    dataType: "JSON",
                                                                    url: "' . Yii::app()->createUrl('/Documents/default/remoteCreateDocumentAjax') . '",
                                                                    data: { file: file, instance: instance }
                                                                })
                                                                .success(function(response) {
                                                                    if(response.state){
                                                                        var input = $("input#' . $input_id . '");
                                                                        //input.val(response.document_id).after("<i>"+response.title+"</i>");
                                                                        //input.val(response.document_id).after("<span class=\'glyphicons check success-created\'><i></i></span>");
                                                                        if(!input.parent().find(".success-created").length) input.after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                                        //$(".' . $show_id . '").hide();
                                                                        $("#' . $modal_id . '").modal("hide");
                                                                    }
                                                                    else
                                                                        msg_notify("bottomLeft", "error", 5000, response.msg);
                                                                });
                                                            });
                                                    });
                                                });
                                            ', CClientScript::POS_END); ?>
                </div>
            <?php } ?>
            <?php if (is_array($useAs) && in_array('special', $useAs)) { ?>
                <div class="tab-pane active" id="special-doc">
                    <div style="margin: 10px;">
                        <?php
                        echo CHtml::button('Creati documentul', array('id' => 'create-special-' . $uniq_id, 'class' => 'btn btn-success pull-right', 'style' => 'margin:10px 0;')); ?>
                    </div>
                    <?php Yii::app()->clientScript->registerScript('files-special-doc', '
                                            $("#create-special-' . $uniq_id . '").click(function(){
                                                $.ajax({
                                                    type: "POST",
                                                    url: "' . Yii::app()->createUrl('/Documents/default/uploadSpecialFile') . '"
                                                })
                                                .done(function() {
                                                        $.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile') . '", function( data ) {
                                                            var file = data;
                                                            var instance = "' . $modelName . '";

                                                            $("input#"+instance+"_document_id").val($.trim(file));
                                                            $("#attach-document-modal-' . $uniq_id . '").modal("hide");
                                                            //$(".show-modal-upload-doc").fadeOut().after("<i>"+file+"</i>");
                                                            //$(".show-modal-upload-doc-' . $uniq_id . '").after("<span class=\'glyphicons check success-created\'><i></i></span>");
                                                            if(!$(".show-modal-upload-doc-' . $uniq_id . '").parent().find(".success-created").length) $(".show-modal-upload-doc-' . $uniq_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                        });
                                                });
                                            });
                                        ', CClientScript::POS_END); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('tabs-upload-doc-' . $uniq_id, '$(".tabs-doc-' . $uniq_id . ' .widget-head li a:first").click();', CClientScript::POS_READY); ?>

<?php Yii::app()->clientScript->registerScript('tabs-upload-doc-' . $uniq_id,
    '$(".tabs-doc-' . $uniq_id . ' .widget-head li a").click(function(){
            var id = $(this).attr("href");
            $(".tabs-doc-' . $uniq_id . ' .tab-pane").hide();
            $(".tabs-doc-' . $uniq_id . ' .tab-pane" + id).show();
        });', CClientScript::POS_END); ?>

