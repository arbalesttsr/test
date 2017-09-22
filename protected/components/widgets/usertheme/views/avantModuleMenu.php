<?php
$data_before = '<li class="dropdown">';
//$data_before .= '<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><i class="fa fa-envelope"></i><span class="badge">'.count($this->items).'</span></a>';
$data_before .= '<a href="#" class="dropdown-toggle module-menu" data-toggle="dropdown"><span class="hidden-xs">';
$data_before .= '<span>' . $this->label . '</span>';
$data_before .= '<span class="badge badge-primary badge-count-module-actions">' . count($this->items) . '</span>';
$data_before .= '<i class="fa fa-caret-down"></i>';
$data_before .= '</a>';
$data_before .= '<ul class="dropdown-menu userinfo arrow">';
$data_before .= '<li class="username"><span>' . $this->label . '</span></li>';
$data_before .= '<li class="userlinks">';
$data_before .= '<ul class="dropdown-menu module-menu">';

$menu_items = array();
foreach ($this->items as $item) {
    if (isset($item['url']) && isset($item['label']) && (!isset($item['visible']) || $item['visible'])) {
        $classes = '';
        $style = 'padding: 5px 7px; margin-bottom: 5px;';
        if (isset($item['icon']) && $item['icon'] !== '') {
            $classes = 'fa fa-' . $item['icon'];
            //$style = 'padding: 5px 7px 5px 17px; margin-bottom: 5px;';
        }
        //$classes = str_replace('glyphicon ', '', $classes);

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
        if (Yii::app()->request->url == $url) {
            if (isset($item['htmlOptions']))
                $item['htmlOptions'] = array_merge($item['htmlOptions'], array('class' => 'active'));
            else
                $item['htmlOptions'] = array('class' => 'active');
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

        if (Yii::app()->user->checkAccess($rbam_url)) {
            $opts = '';
            if (isset($item['htmlOptions']))
                foreach ($item['htmlOptions'] as $key_opt => $option)
                    if(!is_array($option))
                        $opts .= ' ' . $key_opt . '="' . $option . '"';
            if (isset($item['modal']) && $item['modal'])
                $opts .= ' data-toggle="modal"';
            //$menu_items[] = '<li><a class="'.$classes.'" style="'.$style.'" href="'.$url.'" title="'.$item['label'].'" '.$opts.'><i></i>'.$item['label'].'</a></li>';
            //$menu_items[] = '<li '.$opts.'><a href="'.$url.'"><i class="'.$classes.'"></i> <span>'.$item['label'].'</span></a></li>';

            if(strpos($classes,".png") != false)
                $menu_items[] = '<li><a href="' . $url . '" ' . $opts . '>' . $item['label'] . '<img class="pull-right" src="/images/icons/actions/' . str_replace("fa fa-","",$classes) . '"></i></a></li>';
            else
                $menu_items[] = '<li><a href="' . $url . '" ' . $opts . '>' . $item['label'] . '<i class="pull-right ' . $classes . '"></i></a></li>';

        }
    }

}

$data_after = '</ul>';
$data_after .= '</li><!-- user links -->';
$data_after .= '</ul>';
$data_after .= '</li>';

$data = empty($menu_items) ? '<span />' : $data_before . implode('', $menu_items) . $data_after;
//$data = '<div>asdasda</div>';
$script_data = "$('" . $data . "').appendTo('ul.nav.toolbar')";

Yii::app()->clientScript->registerScript('setmodulemenu_' . rand(0, 9999), $script_data, CClientScript::POS_END);

Yii::app()->clientScript->registerCss('settings_badge_count_' . rand(0, 9999),
    '.badge-count-module-actions{position: initial!important;margin: 0 4px!important;background-color: #4f8edc!important;}');