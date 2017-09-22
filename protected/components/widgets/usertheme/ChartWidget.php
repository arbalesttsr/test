<?php

class ChartWidget extends CWidget
{
    //chart types can be: simple, lines, obars, sbars, donut, pie, horizontal, categories
    public $type = 'simple';
    public $title = 'Diagrama';
    public $modal_width = '600';
    public $data = array();
    public $tableGrid = '';
    public $yColumnNamesArr = array();

    public function run()
    {
        $cs = Yii::app()->clientScript;

        $cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.min.js'), CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.pie.js'), CClientScript::POS_END);
        //$cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot_v_7/jquery.flot.tooltip.js'),CClientScript::POS_END);
        //$cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.selection.js'),CClientScript::POS_END);
        //$cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.resize.js'),CClientScript::POS_END);
        //$cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.orderBars.js'),CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.categories.js'), CClientScript::POS_END);
        //$cs->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/assets/scripts/flot/jquery.flot.tooltip.custom.js'),CClientScript::POS_END);

        if (isset($this->tableGrid) && !empty($this->tableGrid) && $this->tableGrid != '' && !empty($this->yColumnNamesArr))
            $this->data = $this->parseGrid();

        if (!empty($this->data)) {
            if (!is_array($this->type)) {
                $uniq_id = md5(time() . $this->title . $this->type . rand(0, 99999));
                $this->render('chartWidget', array('uniq_id' => $uniq_id));
            } else {
                $types = $this->type;
                foreach ($types as $type) {
                    $this->widget('application.components.widgets.usertheme.ChartWidget', array(
                        'type' => $type,
                        'modal_width' => '900',
                        'title' => 'Vizualizare diagrama ()',
                        'tableGrid' => $this->tableGrid,
                        'yColumnNamesArr' => $this->yColumnNamesArr
                    ));
                }
                $this->multipleCharts($types);
            }
        }
    }

    private function parseGrid()
    {
        //gasim toate denumirile coloanelor
        preg_match_all('/<th[^>]*>(.*?)<\/th>/s', $this->tableGrid, $headers);
        $headers = $headers[1];
        //gasim toate valorile coloanelor
        preg_match_all('/<td[^>]*>(.*?)<\/td>/s', $this->tableGrid, $values);
        $values = $values[1];

        //parcurgem titlurile pentru a vedea care coloana corespunde axei Y
        $needleY = false;
        foreach ($headers as $key_header => $val_header) {
            $val_header = preg_replace('!\s+!', ' ', $val_header);
            $val_header = strtolower($val_header);
            $this->yColumnNamesArr = array_map('strtolower', $this->yColumnNamesArr);
            if (count(array_intersect($this->yColumnNamesArr, explode(' ', $val_header))) == count($this->yColumnNamesArr)) {
                $needleY = $key_header;
                break;
            }
        }

        $_data = array();
        if ($needleY !== false && (count($values) % count($headers) == 0)) {
            //die(var_dump('<pre>',$this->partition($values,count($headers)), $needleY,'</pre>'));
            foreach ($this->partition($values, count($headers)) as $row_nr => $data_row) {
                $y_val = '';
                foreach ($data_row as $key_column => $column) {
                    if ($key_column == $needleY) {
                        //var_dump($data_row[$key_column]);
                        $y_val = $column;
                        unset($data_row[$key_column]);
                    }
                }
                $_data['(' . implode(', ', $data_row) . ')'] = (int)$y_val;
            }
            //die();
        }
        return $_data;
    }

    private function partition($list, $p)
    {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

    private function multipleCharts($types)
    {
        $tabs_text = '';

        Yii::app()->clientScript->registerScript('multiple-charts-in-tabs', '
            var modals = $("div[id^=chart-modal-]");
            modals = modals.slice(-' . count($types) . ');
            var i = 0;
            var first_modal = modals.first();
            modals.each(function(){
                i++;
                var _modal = $(this);
                if(i == 1){
                    _modal.find(".modal-body").prepend($(\'<div class="widget widget-2 widget-tabs widget-tabs-2 tabs-charts"><div class="widget-head tabs-charts-head"><ul style="padding-left: 0;"></ul></div></div>\'));
                } else {
                    _modal.find("div[id^=chart-]").detach().appendTo(first_modal.find(".modal-body")).css("display","none");
                }
                console.log($(this));
            });
            var buttons = $("a[href^=#chart-modal-]");
            buttons = buttons.slice(-' . count($types) . ');
            var j = 0;
            var first_button = buttons.first();
            buttons.each(function(){
                j++;
                var _button = $(this);
                if(j == 1){
                    var clone_btn = _button.clone();
                    clone_btn.prepend("<i></i>");
                    clone_btn.attr("class","glyphicons");
                    clone_btn.attr("data-toggle","tab");
                    clone_btn.attr("href",clone_btn.attr("href").replace("#chart-modal-", "#chart-"));
                    clone_btn.click(function(){
                        $(".tabs-charts").parent().find("div[id^=chart-]").hide();
                        $(".tabs-charts").parent().find("div" + clone_btn.attr("href")).show("slow");
                    })
                    var li = $("<li class=\'active\'></li>");
                    li.appendTo(".tabs-charts-head ul").append(clone_btn);
                } else {
                    _button.prepend("<i></i>");
                    _button.attr("class","glyphicons");
                    _button.attr("data-toggle","tab");
                    _button.attr("href",_button.attr("href").replace("#chart-modal-", "#chart-"));
                    _button.live("click", function(){ 
                        $(".tabs-charts").parent().find("div[id^=chart-]").hide();
                        $(".tabs-charts").parent().find("div" + _button.attr("href")).show("slow");
                    })
                    var li = $("<li></li>");
                    _button.detach().appendTo(li);
                    li.appendTo(".tabs-charts-head ul");
                }
            });
                ', CClientScript::POS_LOAD);
        $i = 0;
        foreach ($types as $type) {
            Yii::app()->clientScript->registerScript('multiple-charts-in-tabs-' . $type, '
                $(".tabs-charts .tabs-charts-head").last().find("ul li:eq(' . $i . ')").find("a").text("' . $type . '");
                ', CClientScript::POS_LOAD);
            if (strtolower($type) == 'pie' || strtolower($type) == 'donut') {
                Yii::app()->clientScript->registerScript('multiple-charts-in-tabs-' . $type . 'glyphicon', '
                    $(".tabs-charts .tabs-charts-head").last().find("ul li:eq(' . $i . ')").find("a").addClass("pie_chart").prepend($("<i></i>"));
                    ', CClientScript::POS_LOAD);
            } else {
                Yii::app()->clientScript->registerScript('multiple-charts-in-tabs-' . $type . 'glyphicon', '
                    $(".tabs-charts .tabs-charts-head").last().find("ul li:eq(' . $i . ')").find("a").addClass("charts").prepend($("<i></i>"));
                    ', CClientScript::POS_LOAD);
            }
            $i++;
        }
    }
}

?>
