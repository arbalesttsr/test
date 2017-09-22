<?php
$data_before = '<div style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #E9E9E9">';
$data_before .= '<ul class="nav nav-pills">';
$menu_items = array();
foreach ($this->items as $item) { //die(var_dump($item));
    if (isset($item['url']) && isset($item['label']) && (!isset($item['visible']) || $item['visible'])) {
        $classes = '';
        $style = 'padding: 5px 7px; margin-bottom: 5px;';
        if (isset($item['icon']) && $item['icon'] !== '') {
            $classes = 'glyphicons ' . $item['icon'];
            $style = 'padding: 5px 7px 5px 17px; margin-bottom: 5px;';
        }
        $classes = str_replace('glyphicon ', '', $classes);

        $link = $item['url'][0];
        if (!is_array($item['url']) and strpos($item['url'], "#") !== false)
            $url = $item['url'];
        elseif (count(explode('/', $link)) > 1) {
            unset($item['url'][0]);
            $url = Yii::app()->createUrl($link, $item['url']);
        } else { //die(var_dump($this->getController()->getRoute()));
            $route = $this->getController()->getRoute();
            $route = explode('/', $route);
            $route[count($route) - 1] = $link;
            if (count($item['url']) > 1) {
                unset($item['url'][0]);
                $params = $item['url'];
            } else $params = array();
            $url = Yii::app()->createUrl(implode('/', $route), $params);
        }
        $rbam_url = str_replace('/', ':', $link);
        if ($rbam_url[0] == ':') {
            $rbam_url[0] = ' ';
            $rbam_url = trim($rbam_url);
        }
        $rbam_url = explode(':', $rbam_url);
        foreach ($rbam_url as $key_item => $url_item) {
            $rbam_url[$key_item] = ucfirst($url_item);
        }
        $rbam_url = implode(':', $rbam_url);
        //die(var_dump(Yii::app()->user->checkAccess($rbam_url), $rbam_url, $url, $link));
        if (!isset(Yii::app()->modules['User']['modules']['Rbam']) || Yii::app()->user->checkAccess($rbam_url)) {
            $opts = '';
            if (isset($item['htmlOptions']))
                foreach ($item['htmlOptions'] as $key_opt => $option)
                    $opts .= ' ' . $key_opt . '="' . $option . '"';
            $menu_items[] = '<li><a class="' . $classes . '" style="' . $style . '" href="' . $url . '" title="' . $item['label'] . '" ' . $opts . '><i></i>' . $item['label'] . '</a></li>';
        }
    }

}//die();



$data_after = '</ul><div style="clear:both"></div>';
$data_after .= '</div>';
$data = empty($menu_items) ? '<p></p>' : $data_before . implode('', $menu_items) . $data_after;

$script_data = "$('" . $data . "').prependTo('div#content').slideDown('slow')";

Yii::app()->clientScript->registerScript('setpagemenu_' . rand(0, 9999), $script_data, CClientScript::POS_LOAD);