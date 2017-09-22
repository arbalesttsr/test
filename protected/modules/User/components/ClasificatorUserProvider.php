<?php

/**
 * Description of ClasificatorProvider
 *
 * @author urechean
 */
class ClasificatorUserProvider
{
    public static function getPostList()
    {
        $posts = array();
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                foreach (Post::model()->findAll() as $post)
                    array_push($posts, array('id' => $post->id, 'name' => $post->name));
                return $posts;
            } catch (Exception $ex) {
                return $posts;
            }
        } else {
            return $posts;
        }
    }

    public static function getPostByPk($id)
    {
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                return Post::model()->findByPk($id)->name;
            } catch (Exception $ex) {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getDivisionList()
    {
        $divisions = array();
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                foreach (Division::model()->findAll() as $division)
                    array_push($divisions, array('id' => $division->id, 'name' => $division->name));
                return $divisions;
            } catch (Exception $ex) {
                return $divisions;
            }
        } else {
            return $divisions;
        }
    }

    public static function getDivisionByPk($id)
    {
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                return Division::model()->findByPk($id)->name;
            } catch (Exception $ex) {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getLocalityList()
    {
        $localitys = array();
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                foreach (Locality::model()->findAll() as $locality)
                    array_push($localitys, array('id' => $locality->id, 'name' => $locality->name));
                return $localitys;
            } catch (Exception $ex) {
                return $localitys;
            }
        } else {
            return $localitys;
        }
    }

    public static function getLocalityByPk($id)
    {
        if (isset(Yii::app()->modules['Clasificator'])) {
            try {
                return Locality::model()->findByPk($id)->name;
            } catch (Exception $ex) {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function getProfileClasificatorRelations()
    {
        $relations = array();
        if (isset(Yii::app()->modules['Clasificator'])) {
            if (file_exists(Yii::getPathOfAlias('Clasificator.models') . DIRECTORY_SEPARATOR . 'Post.php')) {
                try {
                    $p = new Post;
                    if (!empty($p))
                        $relations['post'] = array(Profile::BELONGS_TO, 'Post', 'post_id');
                } catch (Exception $ex) {
                }
            }

            if (file_exists(Yii::getPathOfAlias('Clasificator.models') . DIRECTORY_SEPARATOR . 'Locality.php')) {
                try {
                    //$rf = new ReflectionClass('Locality');
                    $l = new Locality;
                    if (!empty($l)) //die(var_dump('empty'));
                        $relations['locality'] = array(Profile::BELONGS_TO, 'Locality', 'locality_id');
                    //else die('test');
                } catch (Exception $ex) {
                }
            }

            if (file_exists(Yii::getPathOfAlias('Clasificator.models') . DIRECTORY_SEPARATOR . 'Division.php')) {
                try {
                    $d = new Division;
                    if (!empty($d))
                        $relations['departament'] = array(Profile::BELONGS_TO, 'Division', 'departament_id');
                } catch (Exception $ex) {
                }
            }
        }
//die(var_dump($relations));
        return $relations;
    }

    /*public static function getHolidaysDates()
    {
        $holidays = array();
        if (isset( Yii::app()->modules['Clasificator']))
        {
            if(file_exists(Yii::getPathOfAlias('Clasificator.models') . DIRECTORY_SEPARATOR . 'Holidays.php')){
                try{
                    $holidays = Holidays::GetListaDatesHolidays();
                }
                catch (Exception $ex) {}
            }


        }
        return $holidays;
    }*/
}

?>
