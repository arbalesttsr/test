<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 7/8/16
 * Time: 4:02 PM
 */
Yii::app()->clientScript->registerScriptFile( '/themes/avant/assets/plugins/clock-widget/clock_widget.js',CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('/themes/avant/assets/plugins/clock-widget/clock_style.css');
?>
<!--<div class="col-md-4 col-sm-4">-->
    <div class="panel panel-teal">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo date('F,l');?></h3>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="jquery-clock small" data-jquery-clock="">
                <li class="jquery-clock-pin"></li>
                <li class="jquery-clock-sec"></li>
                <li class="jquery-clock-min"></li>
                <li class="jquery-clock-hour"></li>
            </ul>
        </div><!-- /.panel-body -->
        <div class="panel-footer">
            <p style="text-align: center;"><?php echo  date("Y-m-d");?> <span id="clock_mine"></span> </p>
        </div><!-- /.panel-footer -->
    </div>
<!--</div>-->
<script>
    

    $(document).ready(function()
    {
        setInterval('updateClock()', 1000);
    });
</script>