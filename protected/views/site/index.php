<fieldset>
    <div class="widget widget-4 pull-left" style="width: 100%;">
        <div class="widget-head"><h4 class="heading">Cautati dupa cod</h4></div>
        <div class="separator"></div>
        <div class="row-fluid">
            <?php echo CHtml::textField('search_code', '', ['class' => 'span12 form-control', 'placeholder' => 'Codul']); ?>

        </div>
    </div>
    <div class="widget widget-4 pull-left" style="width: 100%;">
        <div class="widget-head"><h4 class="heading">Cautati dupa codul de securitate</h4></div>
        <div class="separator"></div>
        <div class="row-fluid">
            <?php echo CHtml::textField('search_secure_code', '', ['class' => 'span12 form-control', 'placeholder' => 'Codul de Securitate']); ?>
        </div>
    </div>
</fieldset>

<hr class="separator bottom">
<div class="buttons pull-right" style="margin-top: 0;">
    <button class="btn btn-danger btn-icon glyphicons remove_2" id="reset_form"><i></i> Resetare</button>
    <button class="btn btn-primary btn-icon glyphicons search" id="search_registers"><i></i> Cautare</button>
</div>
<div class="registersResultList">
</div>
<?php Yii::app()->clientScript->registerCss('bookingOneCss', '
    .widget-head {
        background-color: #fff!important;
    }
    
    .widget-head h4.heading{
        font-size: 13px; 
        padding-left: 5px;
    }
    
    .oneTravelResultList .transport_type i:before{
        font-size: 15px!important;
        color: #2a87a7!important;
    }
    
    ul.ui-autocomplete{
        border: 1px solid #D8D9DA;
    }
    
    div.pager {
        text-align: right;
    }
'); ?>

<?php Yii::app()->clientScript->registerScript('searchRegisterSiteIndex', '


    $("#search_registers").click(function(){
        search_registers();
    })
    
    $("#reset_form").click(function(){
        location.reload(true);
    })
    
    function search_registers(){
        $.ajax({
            type: "POST",
            url: "' . Yii::app()->createUrl("/site/searchRegisters") . '",
            dataType: "html",
            data:{
                search_code:$("#search_code").val(),
                search_secure_code:$("#search_secure_code").val()
            },
        }).done(function(data) {
            $(".registersResultList").html(data);

            $(".registersResultList").prepend($("<div style=\'margin:20px 0;\'></div>"));
            $(".registersResultList").prepend($("<div style=\'clear:both;\'></div>"));
        })
    }
', CClientScript::POS_READY); ?>

<?php Yii::app()->clientScript->scriptMap['jquery.js'] = false; ?>
<?php Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false; ?>
