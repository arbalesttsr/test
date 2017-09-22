<?php $this->breadcrumbs=array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    'Role Based Access Manager',
); ?>

    <div class="col-md-12 iframe-height" style="overflow: hidden; position: relative; height:700px !important; ">
        <iframe src="<?=Yii::app()->createUrl('/User/Rbam')?>" width="100%" height="100%" frameborder="0" _scrolling="no" style="position: relative; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>

<?php Yii::app()->clientScript->registerScript('get-rbam-iframe-height', '
$(".iframe-height").css("height", ( $("#page-content").height() - $("footer").height() - $("header").height()) + "px")
', CClientScript::POS_READY); ?>