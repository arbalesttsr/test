<?php
//$uniq_id = md5(time() . $this->title . $this->type . rand(0,99999));
$id_modal = 'chart-modal-' . $uniq_id;
$id_chart = 'chart-' . $uniq_id;
$name_chart = 'chart_' . $uniq_id;
$chart_data = 'chart_data_' . $uniq_id;
$this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => $id_modal)); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h5 style="margin:0; font-weight: normal;"><?php echo $this->title; ?></h5>
</div>

<div class="modal-body">
    <div id="<?php echo $id_chart; ?>"
         style="width: <?php echo (int)$this->modal_width - 50; ?>px; height: 250px;"></div>
</div>
<?php $this->endWidget(); ?>

<a class="<?php echo $id_modal; ?> btn btn-warning btn-small" href="#<?php echo $id_modal; ?>"
   data-toggle="modal"><?php echo $this->title; ?></a>

<?php $ch_d = '[';
foreach ($this->data as $key => $value) {
    $ch_d .= '["' . $key . '",' . $value . '],';
}
$ch_d .= ']';
$chart_script = '
var ' . $chart_data . ' = ' . $ch_d . ';

function show_tooltip_' . $uniq_id . '(x, y, contents, z) {
    $(\'<div id="bar_tooltip_' . $uniq_id . '">\' + contents + \'</div>\').css({
        top: y - 45,
        left: x - 28,
        \'border-color\': z,
    }).appendTo("body").fadeIn();
}
    
function get_month_name(month_timestamp) {
    var month_date = new Date(month_timestamp);
    var month_numeric = month_date.getMonth();
    var month_array = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var month_string = month_array[month_numeric];

    return month_string;
}

var previous_point = null;
var previous_label = null;
 
$("#' . $id_chart . '").on("plothover", function (event, pos, item) {
    if (item) {
        if ((previous_point != item.dataIndex) || (previous_label != item.series.label)) {
            previous_point = item.dataIndex;
            previous_label = item.series.label;

            $("#bar_tooltip_' . $uniq_id . '").remove();
 
            var x = get_month_name(item.series.data[item.dataIndex][0]),
                y = item.datapoint[1],
                z = item.series.color;
 
            show_tooltip_' . $uniq_id . '(item.pageX, item.pageY,
                "<div style=\'text-align: center;\'><b>" + item.series.label + "</b><br />" + x + ": " + y + "</div>",
                z);
        }
    } else {
        $("#bar_tooltip_' . $uniq_id . '").remove();
        previous_point = null;
        previous_label = null;
    }
});

var ' . $name_chart . ' =
	{
		init: function()
		{ ';

switch (strtolower($this->type)) {
    case "simple":
        $chart_script .= 'this.chart_simple.init();';
        break;
    case "lines":
        $chart_script .= 'this.chart_lines_fill_nopoints.init();';
        break;
    case "obars":
        $chart_script .= 'this.chart_ordered_bars.init();';
        break;
    case "sbars":
        $chart_script .= 'this.chart_stacked_bars.init();';
        break;
    case "donut":
        $chart_script .= 'this.chart_donut.init();';
        break;
    case "pie":
        $chart_script .= 'this.chart_pie.init();';
        break;
    case "horizontal":
        $chart_script .= 'this.chart_horizontal_bars.init();';
        break;
    case "categories":
        $chart_script .= 'this.chart_categories.init();';
        break;
    default:
        break;
}

$chart_script .= '},
		// utility class
		utility:
		{
			chartColors: [ "#37a6cd", "#444", "#777", "#999", "#DDD", "#EEE" ],
			chartBackgroundColors: ["#fff", "#fff"],

			applyStyle: function(that)
			{
				that.options.colors = ' . $name_chart . '.utility.chartColors;
				that.options.grid.backgroundColor = { colors: ' . $name_chart . '.utility.chartBackgroundColors };
				that.options.grid.borderColor = ' . $name_chart . '.utility.chartColors[0];
				that.options.grid.color = ' . $name_chart . '.utility.chartColors[0];
			},
			
			randNum: function()
			{
				return (Math.floor( Math.random()* (1+40-20) ) ) + 20;
			}
		},';

switch (strtolower($this->type)) {

    case 'simple' :
        $chart_script .= '
		chart_simple:
		{
			data: [' . $chart_data . '],
			plot: null,
			options: 
			{ 
				grid: 
				{
                                        show: true,
                                        aboveData: true,
                                        color: "#3f3f3f",
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active: false},
                                        lines: {
                                                show: true,
                                                fill: false,
                                                lineWidth: 4,
                                                steps: false 
                                        },
                                        points: {
                                                show:true,
                                                radius: 5,
                                                symbol: "circle",
                                                fill: true,
                                                borderColor: "#fff"
                                        },
                                },
                                xaxis: {
                                        mode: "categories",
                                        tickLength: 0
                                },
                                legend: { position: "se" },
                                shadowSize:1,
			},
                        
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				this.plot = $.plot($("#' . $id_chart . '"), this.data , this.options);
			}
		},//chart_simple
                ';
        break;

    case 'lines':
        $chart_script .= '
		chart_lines_fill_nopoints: 
		{
			data: [' . $chart_data . '],
			plot: null,
			options: 
			{
				grid: {
                                        show: true,
                                        aboveData: true,
                                        color: "#3f3f3f",
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10 ,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active:false},
                                        lines: {
                                                show: true,
                                                fill: true,
                                                lineWidth: 2,
                                                steps: false
                                        },
                                        points: {show:false}
                                },
                                xaxis: {
                                        mode: "categories",
                                        tickLength: 0
                                },
                                legend: { position: "nw" },
                                yaxis: { min: 0 },
                                colors: [],
                                shadowSize:1,
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_lines_fill_nopoints
                ';
        break;

    case 'obars':
        $chart_script .= '
		chart_ordered_bars:
		{
			data: [' . $chart_data . '],
			plot: null,
			options:
			{
				bars: {
					show:true,
					barWidth: 0.2,
					fill:1
				},
				grid: {
                                        show: true,
                                        aboveData: false,
                                        color: "#3f3f3f" ,
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10 ,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: false,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active:false}
                                },
                                xaxis: {
                                        mode: "categories",
                                        tickLength: 0
                                },
                                legend: { position: "ne" },
                                colors: [],
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_ordered_bars
                ';
        break;

    case 'sbars':
        $chart_script .= '
		chart_stacked_bars:
		{
			data: [' . $chart_data . '],
			plot: null,
			options: 
			{
				grid: {
                                        show: true,
                                        aboveData: false,
                                        color: "#3f3f3f" ,
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10 ,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active:false},
                                        stack: 0,
                                        lines: { show: false, fill: true, steps: false },
                                        bars: { show: true, barWidth: 0.5, fill:1}
                                },
                                xaxis: {mode: "categories", tickLength: 0},
                                legend: { position: "ne" },
                                colors: [],
                                shadowSize:1,
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
                                this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_stacked_bars
                ';
        break;

    case 'donut':
        $chart_script .= '
		chart_donut:
		{
			data: [],
			plot: null,
			options: 
			{
				series: {
					pie: { 
						show: true,
						innerRadius: 0.4,
						highlight: { opacity: 0.1 },
						radius: 1,
						stroke: {
							color: "#fff",
							width: 8
						},
						startAngle: 2,
                                                combine: {
                                                        color: "#EEE",
                                                        threshold: 0.05
                                                },
                                                label: {
                                                        show: true,
                                                        radius: 1,
                                                        formatter: function(label, series){console.log(series);
                                                                return \'<div class="label label-inverse">\'+label+\'&nbsp;\'+Math.round(series.percent)+\'%</div>\';
                                                        }
                                                }
					},
					grow: {	active: false}
				},
				legend:{show:false},
				grid: {
                                        hoverable: true,
                                        clickable: true,
                                        backgroundColor : { }
                                },
                                colors: [],
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				
                                var donut_data = [];
                                $.each(' . $chart_data . ', function( index, value ) {
                                        var obj = {
                                                "label": value[0],
                                                "data": parseInt(value[1])
                                        };
                                        donut_data.push(obj);
                                });
                                this.data = donut_data;
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_donut
                ';
        break;

    case 'pie':
        $chart_script .= '
		chart_pie:
		{
			data: [],
			plot: null,
			options: 
			{
				series: {
					pie: { 
						show: true,
						highlight: { opacity: 0.1 },
						radius: 1,
						stroke: {
							color: "#fff",
							width: 2
						},
						startAngle: 2,
                                                combine: {
                                                        color: "#353535",
                                                        threshold: 0.05
                                                },
                                                label: {
                                                        show: true,
                                                        radius: 1,
                                                        formatter: function(label, series){
                                                                return \'<div class="label label-inverse">\'+label+\'&nbsp;\'+Math.round(series.percent)+\'%</div>\';
                                                        }
                                                }
					},
					grow: {	active: false}
				},
				colors: [],
				legend:{show:false},
				grid: {
                                        hoverable: true,
                                        clickable: true,
                                        backgroundColor : { }
                                },
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
                                    
                                var pie_data = [];
                                $.each(' . $chart_data . ', function( index, value ) {
                                        var obj = {
                                                "label": value[0],
                                                "data": parseInt(value[1])
                                        };
                                        pie_data.push(obj);
                                });
                                this.data = pie_data;
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_pie
                ';
        break;

    case 'horizontal':
        $chart_script .= '
		chart_horizontal_bars:
		{
			data: [' . $chart_data . '],
			plot: null,
			options: 
			{
				grid: {
                                        show: true,
                                        aboveData: false,
                                        color: "#3f3f3f" ,
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10 ,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: false,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active:false},
                                        bars: {
                                                show:true,
                                                horizontal: true,
                                                barWidth:0.2,
                                                fill:1
                                        }
                                },
                                xaxis: {mode: "categories", tickLength: 0},
                                legend: { position: "ne" },
                                colors: [],
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_horizontal_bars
                ';
        break;

    case 'categories':
        $chart_script .= '
		chart_categories:
		{
			data: [' . $chart_data . '],
			plot: null,
			options: 
			{ 
				grid: 
				{
                                        show: true,
                                        aboveData: true,
                                        color: "#3f3f3f",
                                        labelMargin: 20,
                                        axisMargin: 0, 
                                        borderWidth: 0,
                                        borderColor:null,
                                        minBorderMargin: 10,
                                        clickable: true, 
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 20,
                                        backgroundColor : { }
				},
                                series: {
                                        grow: {active: false},
                                        lines: {
                                                show: true,
                                                fill: false,
                                                lineWidth: 0,
                                                steps: false 
                                        },
                                        points: {
                                                show:true,
                                                radius: 5,
                                                symbol: "circle",
                                                fill: true,
                                                borderColor: "#fff"
                                        },
                                        bars: {
                                                show: true,
                                                barWidth: 0.6,
                                                align: "center"
                                        }
                                },
                                xaxis: {
                                        mode: "categories",
                                        tickLength: 0
                                },

                                legend: { position: "se" },
                                shadowSize:1
			},
			init: function()
			{
				' . $name_chart . '.utility.applyStyle(this);
				this.plot = $.plot($("#' . $id_chart . '"), this.data, this.options);
			}
		},//chart_categories
                ';
        break;

    default:
        break;
}

$chart_script .= '
        } 
';

$chart_script .= '$(function(){' . $name_chart . '.init();});';
?>

<?php Yii::app()->clientScript->registerScript($id_modal,
    '
            $("#' . $id_modal . ' .modal-dialog").css("width","' . $this->modal_width . 'px");
            ' . $chart_script . '
        ', CClientScript::POS_READY); ?>

<?php if (Yii::app()->request->isAjaxRequest)
    Yii::app()->clientScript->registerScript($id_modal . '-onshow',
        '
            $("#' . $id_modal . '").on("shown.bs.modal", function () {
                $(this).insertBefore("#content").css({"top":"70px","display":"block!important"}).removeClass("hide");
                $(window).resize();
            });
        ', CClientScript::POS_READY); ?>

<?php Yii::app()->clientScript->registerCss($id_modal, '
            #flotTip{z-index:99999!important;} 
            #' . $id_modal . ' .label-inverse {background-color: #333;}
            #bar_tooltip_' . $uniq_id . ' {
                font-size: 13px;
                position: absolute;
                display: none;
                padding: 2px;
                border: 2px solid;
                -webkit-border-radius: 5px;
                border-radius: 5px;
                background-color: #FFF;
                opacity: 0.8;
                z-index:99999!important;
            }
        '); ?> 