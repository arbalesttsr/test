<?php
$data = '<li class="hidden-phone">';
$data .= '<a href="#" data-toggle="dropdown" class="glyphicons ' . $this->icon . '">';
$data .= '<i></i><span class="hidden-phone">' . $this->label . '</span></a>';
$data .= '<ul class="dropdown-menu pull-right">';
?>
<?php foreach ($this->items as $item) {
    $data .= '<li><a href="' . $item['url'] . '" title="' . $item['label'] . '">' . $item['label'] . '</a></li>';
}
$data .= '</ul></li>';
$script_data = "$('" . $data . "').prependTo('ul.topnav')";

Yii::app()->clientScript->registerScript('setmodulemenu_' . rand(0, 9999), $script_data, CClientScript::POS_END);