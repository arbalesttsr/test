<?php

class AvantLeftMenu extends CWidget
{
    public $menuarray;

    public function run()
    {
        try{
        if (isset(Yii::app()->modules['DynamicMenu'])) {
            if (!Yii::app()->user->isGuest) {
                $roles_menu = array();
                $roles = Yii::app()->authManager->getRoles(Yii::app()->user->id);
                foreach ($roles as $key => $role) {
                    $roles_menu[] = $key;
                }
            } else
                $roles_menu = array('Guest');

            $config = new Config;

            //die(var_dump($config->getLeftMenuArray($roles_menu)));
            //$this->menuarray = $config->getLeftMenuArray($roles_menu);
            $this->render('avantLeftMenu', array('menuarray' => $config->getLeftMenuArray($roles_menu)));
        } else
            //$this->menuarray = array();
            $this->render('avantLeftMenu', array('menuarray' => array()));

        }
        catch(Exception $ex){
            $this->render('avantLeftMenu', array('menuarray' => array()));
        }
    }
}

?>
                