<?php
$data_before = '<div class="collapse navbar-collapse navbar-ex1-collapse large-icons-nav">';
//$data_before  = '<div class="collapse navbar-collapse navbar-ex1-collapse large-icons-nav" id="horizontal-navbar">';
//$data_before .= '<ul class="nav navbar-nav">';

$menu_items = array();
foreach ($this->items as $item) {
    if (isset($item['url']) && isset($item['label']) && (!isset($item['visible']) || $item['visible'])) {
        $classes = '';
        $style = 'margin: 0 5px 5px 0;';
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

        if (!isset(Yii::app()->modules['User']['modules']['Rbam']) || Yii::app()->user->checkAccess($rbam_url)) {
            $opts = '';
            if (isset($item['htmlOptions']))
                foreach ($item['htmlOptions'] as $key_opt => $option)
                    if(!is_array($option))
                        $opts .= ' ' . $key_opt . '="' . $option . '"';
            if (isset($item['modal']) && $item['modal'])
                $opts .= ' data-toggle="modal"';
            //$menu_items[] = '<li><a class="'.$classes.'" style="'.$style.'" href="'.$url.'" title="'.$item['label'].'" '.$opts.'><i></i>'.$item['label'].'</a></li>';

            if (isset($item['icon']) && $item['icon'] !== '')
                if(strpos($classes,".png") != false)
                    $menu_items[] = '<a ' . $opts . ' style="' . $style . '" href="' . $url . '" class="" title="' . $item['label'] . '"><img src="/images/icons/actions/' . str_replace("fa fa-","",$classes) . '"></a>';
                else
                    $menu_items[] = '<a ' . $opts . ' style="' . $style . '" href="' . $url . '" class="btn btn-primary-alt" title="' . $item['label'] . '"><i class="' . $classes . '"></i></a>';
            else
                $menu_items[] = '<a ' . $opts . ' style="' . $style . '" href="' . $url . '" class="btn btn-primary-alt" title="' . $item['label'] . '">' . $item['label'] . '</a>';
        }
    }

}


//$data_after  = '</ul>';
$data_after = '</div>';

$data = empty($menu_items) ? '<p></p>' : '<hr/>' . $data_before . implode('', $menu_items) . $data_after;
//$data = '<div>asdasda</div>';
$script_data = "$('" . $data . "').appendTo('div#page-heading')";

Yii::app()->clientScript->registerScript('setmodulemenu_' . rand(0, 9999), $script_data, CClientScript::POS_END);
?>
