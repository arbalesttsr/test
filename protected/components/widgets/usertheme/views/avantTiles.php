<?php $tile_content = '<';
$is_tile_link = ($this->href != '#');
if (!$is_tile_link)
    $tile_content .= 'span ';
else
    $tile_content .= 'a href="' . $this->href . '" ';

$tile_content .= 'class="' . $this->type . '-tiles tiles-' . $this->color . '" >';

if ($this->heading != '')
    $tile_content .= '<div class="tiles-heading">' . $this->heading . '</div>';

$tile_content .= '<div class="tiles-body">';

$tile_content .= '<div class="pull-left"><i class="fa fa-' . $this->icon . '"></i></div>';

$tile_content .= '<div class="pull-right">' . $this->text . '</div>';

$tile_content .= '</div>';

//if($this->footer != '')
$tile_content .= '<div class="tiles-footer">' . $this->footer . '</div>';

if (!$is_tile_link)
    $tile_content .= '</span>';
else
    $tile_content .= '</a>';

//var_dump($this->footer != '');
echo $tile_content;