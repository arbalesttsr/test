<div id="menuInner">


    <!--ul style="margin-bottom: 0;"><li class="heading"><span>Base</span></li></ul>
        <li class="glyphicons home my_menu_item">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">
          <i></i><span>Dashboard</span></a>
        </li>
      <div class="my_submenu" id="collapseOne" class="collapse">

          <li class="glyphicons home"><a><i></i><span>Anim pariatur cliche reprehenderit,</span></a></li>
          <li>enim eiusmod high life accusamus</li>

      </div-->


    <?php foreach ($menuarray as $menumodule) { ?>
        <?php echo parse_array($menumodule); ?>
    <?php } ?>
</div>


<?php function parse_array($menuarray = array(), $submenu = '')
{
    $menu = '';
    if (isset($menuarray['heading'])) {
        $menu .= '<ul class="my_heading"><li class="heading"><span>' . $menuarray['heading'] . '</span></li></ul>';
        unset($menuarray['heading']);
    }

    $sm = false;
    if ($submenu != '' && $submenu != null)
        $sm = true;

    if ($sm)
        $menu .= '<div class="my_submenu collapse" id="' . $submenu . '" class="my_submenu" class="collapse">';

    for (; !isset($menuarray[0]['title']); $menuarray = $menuarray[0]) {
    }

    foreach ($menuarray as $menuitem) {
        $menu .= '<li';
        if (isset($menuitem['submenu'])) {
            $collapse = strtolower(str_replace(' ', '_', $menuitem['title'] . '_' . md5($menuitem['title'] . rand(0, 999))));
            $menu .= ' class="my_menu_item';
            if (isset($menuitem['icon']))
                $menu .= ' fa ' . $menuitem['icon'] . '"';
            $menu .= '">';
            $menu .= '<a data-toggle="collapse"';

            $menu .= ' href="#' . $collapse . '">';
            if (isset($menuitem['icon']))
                $menu .= '<i></i>';
            $menu .= '<span>' . $menuitem['title'] . '</span></a>';
            $menu .= '</li>';
            $menu .= parse_array($menuitem['submenu'], $collapse);
        } else {
            if (isset($menuitem['icon']))
                $menu .= ' class="fa ' . $menuitem['icon'] . '"';
            $menu .= '><a href="' . Yii::app()->createUrl($menuitem['href']) . '">';
            if (isset($menuitem['icon']))
                $menu .= '<i></i>';
            $menu .= '<span>' . $menuitem['title'] . '</span></a>';
            $menu .= '</li>';
        }
    }

    if ($sm)
        $menu .= '</div>';
    return $menu;
} ?>


<?php /* function parse_array($menuarray = array(), $submenu = '')
{
    $menu = '<ul';
    if($submenu != '' && $submenu != null)
        $menu .= ' class="collapse" id="' . $submenu . '"';
    $menu .= '>';
    if(isset($menuarray['heading']))
    {
        $menu .= '<ul style="margin-bottom:0"><li class="heading"><span>' . $menuarray['heading'] . '</span></li></ul>';
        unset($menuarray['heading']);
    }

    for(;!isset($menuarray[0]['title']);$menuarray = $menuarray[0]) {}

    foreach($menuarray as $menuitem)
    {
        $menu .= '<li';
        if(isset($menuitem['submenu']))
        {
            $collapse = strtolower(str_replace(' ', '_', $menuitem['title'] . '_' . md5($menuitem['title'] . rand(0,999))));
            $menu .= ' class="hasSubmenu">';
            $menu .= '<a data-toggle="collapse"';
            
            if(isset($menuitem['icon']))
                $menu .= ' class="glyphicons ' . $menuitem['icon'] . ' collapsed"';
            $menu .= ' href="#' . $collapse . '">';
            if(isset($menuitem['icon']))
                $menu .= '<i></i>';
            $menu .= '<span>' . $menuitem['title'] . '</span></a>';
            $menu .= parse_array($menuitem['submenu'], $collapse);
        }
        else
        {
            if(isset($menuitem['icon']))
                $menu .= ' class="glyphicons ' . $menuitem['icon'] . '"';
            $menu .= '><a href="' . $menuitem['href'] . '">';
            if(isset($menuitem['icon']))
                $menu .= '<i></i>';
            $menu .= '<span>' . $menuitem['title'] . '</span></a>';
        }
        $menu .= '</li>';
    }
    
    $menu .= '</ul>';
    return $menu;
} */ ?>