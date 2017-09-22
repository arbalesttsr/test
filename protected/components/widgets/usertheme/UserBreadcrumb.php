<?php

class UserBreadCrumb extends CWidget
{

    public $crumbs = array();
    public $delimiter = '<li class="divider"></li>';

    public function run()
    {
        $this->render('userbreadcrumb');
    }

}

?>