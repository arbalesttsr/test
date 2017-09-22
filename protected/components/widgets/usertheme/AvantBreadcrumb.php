<?php

class AvantBreadCrumb extends CWidget
{

    public $crumbs = array();
    public $delimiter = '<li class="divider"></li>';

    public function run()
    {
        $this->render('avantBreadcrumb');
    }

}

?>