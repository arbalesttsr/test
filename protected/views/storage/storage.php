<?php
/**
 * Created by PhpStorm.
 * User: tudor
 */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    Yii::t('t', 'SYNAPSIS_STORAGE')
];
?>
    <h3 class="fa fa-archive"><i></i>Synapsis Storage</h3>
    <hr>


<?php

if (isset(Yii::app()->modules['PhpEditor'])) {

    if(HelperPhpEditor::have_access())
    {
        $path = [];
        if (!is_null(Yii::app()->user)) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $roles = array_keys(Yii::app()->authManager->getRoles(Yii::app()->user->id));

            $path = [];

            if (Yii::app()->user->isSa()) {
                $register = PhpeditorPath::model()->findAll();
                if (sizeof($register)) {
                    foreach ($register as $item) {
                        $path[] = $item->path;
                    }
                }
            } else {
                $criteriaRoles = new CDbCriteria;
                $criteriaRoles->condition = "t.user_id = $user->id OR t.role_name IN('" . implode("', '", $roles) . "')";
                $register = PhpeditorPathRights::model()->findAll($criteriaRoles);

                if (sizeof($register)) {
                    foreach ($register as $item) {
                        $path[] = $item->pathRights->path;
                    }
                }
            }
        }
        $len = sizeof($path);
        if ($len) {
                $this->widget('ext.elFinder.ElFinderWidget', [
                    'connectorRoute' => 'elfinderstorage/connector', // relative route for elFinder connector action
                ]);
        } else {
            echo '<h2>In module PhpEditor not set eny path, please set path in this module and try again.</h2>';
        }

    }else
        echo '<h2>In module PhpEditor not set your IP, please set your IP in this module and try again.</h2>';
} else {
    echo '<h2>Module PhpEditor is not set.</h2> ';
}

