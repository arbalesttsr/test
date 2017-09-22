<?php Yii::import('application.modules.Documents.controllers.DefaultController');
//$dtController = new DefaultController; ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/assets/plugins/dropzone/css/dropzone.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/plugins/dropzone/dropzone.js', CClientScript::POS_END); ?>

<?php $uniq_id = md5($modelName . $attrName . time() . rand() . rand());
$dt_modal_id = 'dt-attach-document-modal-' . $uniq_id;
$doc_modal_id = 'doc-attach-document-modal-' . $uniq_id;
$uploader_id = 'dropzone-' . $uniq_id;
$input_id = 'doc-' . $uniq_id;
$dt_show_id = 'dt-show-modal-upload-doc-' . $uniq_id;
$doc_show_id = 'doc-show-modal-upload-doc-' . $uniq_id;
?>
<?php $is_disabled = false;
$document_title = ''; ?>
<?php if (isset($model->$attrName) && (file_exists($model->$attrName) || is_numeric($model->$attrName))) {
    $is_disabled = true;
    if (is_numeric($model->$attrName))
        $document_title = Document::model()->findByPk($model->$attrName)->title;
} ?>

<?php echo CHtml::activeHiddenField($model, $attrName, array('id' => $input_id));//elementul care pastreaza id-ul documentului in forma ?>
<?php if ($selectExistent && $createNew) { ?>
    <div class="col-sm-6"><div class="input-group">
<?php }
if ($selectExistent) {
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'name' => 'searchbox_' . $uniq_id,
        'value' => $document_title,
        //'source'=>$this->createUrl('getDestinations'),
        'source' => 'js: function(request, response) {
            $.ajax({
                url: "' . Yii::app()->createUrl('/Documents/default/getDocumentsByDtTitle') . '",
                dataType: "json",
                data: {
                    term: request.term,
                    modelName: "' . $modelName . '"
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
            'class' => 'span10 form-control',
            'placeholder' => "Scrieti pentru cautare " . $modelName,
        ),
    ));
}
if ($createNew && $selectExistent) { ?>
    <div class="input-group-btn" style="z-index: 99;">
        <a href="#<?php echo $dt_modal_id; ?>" data-toggle="modal" type="button" class="btn btn-primary"><i
                class="fa fa-plus-circle"></i></a>
    </div>
<?php } elseif ($createNew && !$selectExistent) { ?>
    <a href="#<?php echo $dt_modal_id; ?>" data-toggle="modal" class="btn btn-primary btn-label"><i
            class="fa fa-plus-circle"></i>Creati <?= $modelName; ?></a>
<?php } ?>
<?php if ($createNew) {
    $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => $dt_modal_id)); //primul modal in care se afla dt-ul ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 style="margin:0; font-weight: normal;">Creati <?= $modelName; ?></h5>
    </div>
    <div class="modal-body">
        <?php $dt = new $modelName;
        $attributeLabels = $dt->attributeLabels();
        $formAttributes = $dt->formAttributes(); ?>
        <div class="form form-<?= $uniq_id; ?>">
            <?php /*echo CHtml::beginForm('','post', array(
                    'id' => 'create-'.$modelName.'-form',
                    'class' => 'form-'.$uniq_id
                ));*/ ?>
            <?php echo CHtml::hiddenField('modelName', $modelName); ?>
            <div class="row">
                <?php echo CHtml::label($attributeLabels['document_id'], 'document_id'); ?>
                <a class="btn btn-primary btn-icon glyphicons file <?php echo $doc_show_id; ?>"
                   href="#<?php echo $doc_modal_id; ?>" data-toggle="modal">Incarcati fisier</a>
                <?php //echo CHtml::hiddenField($modelName . '[document_id]', '', array('id'=>CHtml::activeId($model, 'document_id'))); ?>
            </div>
            <div class="rows_reponse_<?= $uniq_id; ?>"></div>
            <?php //Yii::app()->runController('Documents/default/getAllFormInputs/modelName/'.$modelName); ?>
            <?php Yii::app()->clientScript->registerScript('get-content-form-inputs-' . $uniq_id, '
                        $("#' . $dt_modal_id . '").on("shown.bs.modal", function() {
                            $.get("' . Yii::app()->createUrl('Documents/default/getAllFormInputs', array('modelName' => $modelName)) . '",
                                function( data ) {
                                    $(".rows_reponse_' . $uniq_id . '").html($(data));
                                    reDrawPageElements();
                            });
                        });', CClientScript::POS_READY); ?>
            <?php echo CHtml::ajaxSubmitButton(
                'Creare',
                CHtml::normalizeUrl(array('/Documents/default/validateRemoteDoc')),
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
                                    $(".' . $dt_show_id . '").attr("disabled", "disabled").removeClass("btn-primary").addClass("btn-success ok_2");
                                    //if(!$(".' . $input_id . '").parent().find(".success-created").length) $(".' . $input_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                    $("#' . $dt_modal_id . '").modal("hide");
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
    <?php if ($selectExistent && $createNew) { ?>
        </div></div>
    <?php } ?>

    <?php $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => $doc_modal_id)); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 style="margin:0; font-weight: normal;">Ataseaza un document</h5>
    </div>

    <div class="modal-body">
        <!--div class="widget widget-2 widget-tabs widget-tabs-2 tabs-doc-<?php echo $uniq_id; ?>"-->
        <div class="tab-container tab-danger tabs-doc-<?php echo $uniq_id; ?>">
            <?php $useAs = $modelName::model()->useAs(); ?>
            <div class="widget-head">
                <ul class="nav nav-tabs" style="padding-left: 0;">
                    <?php if (is_array($useAs) && in_array('file', $useAs)) { ?>
                        <li><a class="glyphicons file_import" href="#upload-doc-"<?= $uniq_id ?>
                               data-toggle="tab"><i></i>Incarcati fisier</a></li>
                    <?php } ?>
                    <?php if (is_array($useAs) && in_array('template', $useAs)) { ?>
                        <li><a class="glyphicons pencil" href="#template-doc-"<?= $uniq_id ?> data-toggle="tab"><i></i>Alegeti
                                un Sablon DOCX</a></li>
                    <?php } ?>
                    <?php if (is_array($useAs) && in_array('template_pdf', $useAs)) { ?>
                        <li><a class="glyphicons pencil" href="#template-pdf-"<?= $uniq_id ?> data-toggle="tab"><i></i>Alegeti
                                un Sablon PDF</a></li>
                    <?php } ?>
                    <?php if (is_array($useAs) && in_array('special', $useAs)) { ?>
                        <li><a class="glyphicons magic" href="#special-doc-"<?= $uniq_id ?> data-toggle="tab"><i></i>Alegeti
                                un Sablon</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="tab-content" style="padding: 0; overflow: hidden;">
                <?php if (is_array($useAs) && in_array('file', $useAs)) { ?>
                    <div class="tab-pane active" id="upload-doc-"<?= $uniq_id ?>>
                        <div class="dropzone" id="<?= $uploader_id ?>"></div>

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
                                        $extensions[] = '.' . $ext_model->extension;
                                $max_file_size = $cat->file_size;
                            }
                        }
                        ?>
                        <?php Yii::app()->clientScript->registerScript('dropzone-script-data-' . $uniq_id, '
                                                var myDropzone_' . $uniq_id . ' = new Dropzone(
                                                    "div#' . $uploader_id . '", {
                                                        url: "' . Yii::app()->createUrl('/Documents/default/uploadDocumentFile') . '",
                                                        maxFilesize: ' . $max_file_size . ', // MB
                                                        addRemoveLinks: true,
                                                        uploadMultiple: false,
                                                        maxFiles: 1,
                                                        acceptedFiles: "' . implode(',', $extensions) . '",
                                                        dictDefaultMessage: "Trageti un fisier aici pentru a crea Documentul",
                                                        dictFallbackMessage: "Browserul Dvs nu suporta drag and drop.",
                                                        dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                                                        dictFileTooBig: "Marimea fisierului este prea mare ({{filesize}}MiB). Marimea maxima acceptata: {{maxFilesize}}MiB.",
                                                        dictInvalidFileType: "Nu puteti incarca fisiere cu aceasta extensie",
                                                        dictResponseError: "Serverul a raspuns cu statutul {{statusCode}}.",
                                                        dictCancelUpload: "Opriti incarcarea",
                                                        dictCancelUploadConfirmation: "Sunteti sigur ca doriti sa opriti aceasta incarcare?",
                                                        dictRemoveFile: "Stergeti",
                                                        dictRemoveFileConfirmation: null,
                                                        dictMaxFilesExceeded: "Nu puteti incarca mai multe fisiere.",

                                                        init: function() {
                                                            this.on("success", function(file, response) {
                                                                var obj = jQuery.parseJSON(response)
                                                                if(obj.state){
                                                                    var file = obj.filepath;
                                                                    var instance = "' . $modelName . '";

                                                                    $(".rows_reponse_' . $uniq_id . ' input#"+instance+"_document_id").val($.trim(file));
                                                                    $("#' . $doc_modal_id . '").modal("hide");

                                                                    if(!$(".' . $doc_show_id . '").parent().find(".success-created").length)
                                                                        $(".' . $doc_show_id . '").addClass("btn-label disabled").prepend($("<i class=\"fa fa-check success-created\"></i>"));
                                                                    $(".' . $doc_show_id . '").removeClass("btn-primary").addClass("btn-success");

                                                                }
                                                                console.log(obj);
                                                            })
                                                        }
                                                    }
                                                );
                                                console.log(myDropzone_' . $uniq_id . ')', CClientScript::POS_READY); ?>
                    </div>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('template', $useAs)) { ?>
                    <div class="tab-pane active" id="template-doc-"<?= $uniq_id ?>>
                        <div style="margin: 10px;">
                            <?php $dt = DocumentType::model()->findByAttributes(array('instance_model_name' => $modelName));
                            $dt_templates = DocumentsTypesTemplatesLink::model()->findAllByAttributes(array('type_id' => $dt->id)); //die(var_dump($dt_templates));
                            if (empty($dt_templates))
                                echo 'Din pacate nu a fost setat nici un sablon pentru acest tip de document. <a href="' . Yii::app()->createUrl('/Documents/template/admin') . '">Setati un sablon</a>';
                            else {
                                $in = array();
                                foreach ($dt_templates as $dt_template)
                                    $in[] = $dt_template->template_id;
                                echo CHtml::dropDownList('template_id', '', CHtml::listData(DocumentsTemplates::model()->findAllByPk($in), 'id', 'name'), array('class' => 'form-control'));
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
                                                        .success(function(data) {
                                                                /*$.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile', array('state' => 'upload_wizard')) . '", function( data ) {*/
                                                                if($.trim(data) != "0"){
                                                                    var file = data;
                                                                    var instance = "' . $modelName . '";

                                                                    $(".rows_reponse_' . $uniq_id . ' input#"+instance+"_document_id").val($.trim(file));
                                                                    //if(!$(".' . $doc_show_id . '").parent().find(".success-created").length) $(".' . $doc_show_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                                    $(".' . $doc_show_id . '").attr("disabled", "disabled").removeClass("btn-primary").addClass("btn-success btn-label").prepend($("<i class=\"fa fa-check success-created\"></i>"));
                                                                    $("#' . $doc_modal_id . '").modal("hide");
                                                                /*});*/
                                                                }
                                                        });
                                                    });
                                                ', CClientScript::POS_END); ?>
                    </div>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('template_pdf', $useAs)) { ?>
                    <div class="tab-pane active" id="template-pdf-"<?= $uniq_id ?>>
                        <div style="margin: 10px;">
                            <?php $dt = DocumentType::model()->findByAttributes(array('instance_model_name' => $modelName));
                            $dt_templates = DocumentsTypesTemplatesPdfLink::model()->findAllByAttributes(array('type_id' => $dt->id)); //die(var_dump($dt_templates));
                            if (empty($dt_templates))
                                echo 'Din pacate nu a fost setat nici un sablon pentru acest tip de document. <a href="' . Yii::app()->createUrl('/Documents/template/admin') . '">Setati un sablon</a>';
                            else {
                                $in = array();
                                foreach ($dt_templates as $dt_template)
                                    $in[] = $dt_template->template_id;
                                echo CHtml::dropDownList('template_pdf_id_' . $uniq_id, '', CHtml::listData(DocumentsTemplatesPdf::model()->findAllByPk($in), 'id', 'name'), array('class' => 'form-control'));
                                echo CHtml::button('Creati documentul', array('id' => 'choose-template-pdf-' . $uniq_id, 'class' => 'btn btn-success pull-right', 'style' => 'margin:10px 0;'));
                            } ?>
                        </div>
                        <?php Yii::app()->clientScript->registerScript('files-template-doc-' . $uniq_id, '
                                        $("#choose-template-pdf-' . $uniq_id . '").click(function(){
                                            $.ajax({
                                                type: "POST",
                                                url: "' . Yii::app()->createUrl('/Documents/default/uploadTemplateFilePdf', array('state' => 'upload_wizard')) . '",
                                                data: { template_id: $("#template_pdf_id_' . $uniq_id . '").val() }
                                            })
                                            .success(function(data) {
                                                    /*$.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile', array('state' => 'upload_wizard')) . '", function( data ) {*/
                                                    if($.trim(data) != "0"){
                                                        var file = data;
                                                        var instance = "' . $modelName . '";

                                                        $(".rows_reponse_' . $uniq_id . ' input#"+instance+"_document_id").val($.trim(file));
                                                        //if(!$(".' . $doc_show_id . '").parent().find(".success-created").length) $(".' . $doc_show_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                        $(".' . $doc_show_id . '").attr("disabled", "disabled").removeClass("btn-primary").addClass("btn-success btn-label").prepend($("<i class=\"fa fa-check success-created\"></i>"));
                                                        $("#' . $doc_modal_id . '").modal("hide");
                                                    /*});*/
                                                    }

                                            });
                                        });
                                    ', CClientScript::POS_END); ?>
                    </div>
                <?php } ?>
                <?php if (is_array($useAs) && in_array('special', $useAs)) { ?>
                    <div class="tab-pane active" id="special-doc-"<?= $uniq_id ?>>
                        <div style="margin: 10px;">
                            <?php
                            echo CHtml::button('Creati documentul', array('id' => 'create-special-' . $uniq_id, 'class' => 'btn btn-success pull-right', 'style' => 'margin:10px 0;')); ?>
                        </div>
                        <?php Yii::app()->clientScript->registerScript('files-special-doc', '
                                                $("#create-special-' . $uniq_id . '").click(function(){
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "' . Yii::app()->createUrl('/Documents/default/uploadSpecialFile', array('state' => 'upload_wizard')) . '"
                                                    })
                                                    .done(function(data) {
                                                            /*$.get( "' . Yii::app()->createUrl('/Documents/default/getDocumentFile') . '", function( data ) {*/
                                                            if($.trim(data) != "0") {
                                                                var file = data;
                                                                var instance = "' . $modelName . '";

                                                                $(".rows_reponse_' . $uniq_id . ' input#"+instance+"_document_id").val($.trim(file));
                                                                //if(!$(".' . $doc_show_id . '").parent().find(".success-created").length) $(".' . $doc_show_id . '").after($("<span class=\'glyphicons check success-created\'><i></i></span>"));
                                                                $(".' . $doc_show_id . '").attr("disabled", "disabled").removeClass("btn-primary").addClass("btn-success ok_2");
                                                                $("#' . $doc_modal_id . '").modal("hide");
                                                            /*});*/
                                                            }
                                                    });
                                                });
                                            ', CClientScript::POS_END); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

    <?php Yii::app()->clientScript->registerCss('modals-styles' . $uniq_id,
        '#' . $dt_modal_id . '{z-index:8888}
            #' . $doc_modal_id . '{z-index:9999}
            a.create-new-doc {width: 35px!important; height: 35px!important;}
            a.create-new-doc i:before {font-size: 23px!important;}'
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
                console.log(form,$("form-' . $uniq_id . '"))
            }
            ', CClientScript::POS_END); ?>
<?php } //if create new //Yii::app()->clientScript->scriptMap['jquery.js']=false;?>
<?php Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false; ?>