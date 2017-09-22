<?php

class UserMonitoring extends CWidget
{
    public function init()
    {
    }


    public function run()
    {

        if (!Yii::app()->user->isGuest) {
            Yii::app()->session[Yii::app()->user->name] = Yii::app()->user->name;
        }
        $path = realpath(session_save_path());
        $files = scandir($path);
        $filesname = array();

        foreach ($files as $file) {

            if (strstr($file, 'sess_')) {
                $filesname[] = $file;
            }
        }
        $users = array();
        foreach ($filesname as $fname) {
            $str = file_get_contents($path . '/' . $fname);
            if (!empty($str)) {
                $elements = explode('|', $str);
                $element = explode(':', end($elements));
                $label = strtok(end($element), "\"");

                if ($label != "/modules/") {
                    $arr = array('label' => $label, 'url' => array(''));
                    $exist = array();
                    try {
                        $criteria = new CDbCriteria();
                        $criteria->addCondition("username like ':username'");
                        $exist = User::model()->findAll($criteria, array(':username' => $arr['label'],));
                        //$exist = User::model()->findAll('username = "'.$arr['label'].'"');
                    } catch (Exception $e) {
                    }
                    if (!empty($exist))
                        $users[] = $arr;
                }

                /*for ($i = 0; $i<count($users)-1;$i++ ){
                    for ($j = 0; $j<count($users);$j++ ){
                        if ($users[$i]['label']==$users[$j]['label']){
                            unset($users[$j]['label']);
                        }
                    }
                }*/
            }
        }
        $users = array_map("unserialize", array_unique(array_map("serialize", $users)));
        $this->render('usermonitoring', array('users' => $users));
    }

}

?>