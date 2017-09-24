<?php

class GeneralValueBehavior extends CActiveRecordBehavior
{

    /**
     * @var array Model attributes available for translate
     */
    public $translateAttributes = array();

    /**
     * @var string
     */
    public $relationName = 'translate';

    /**
     * @var integer Language id used to load model translation data.
     * If null active language id we'll be used.
     */
    // private $_translation_lang;

    /**
     * @param $owner
     */
    public function attach($owner)
    {
        return parent::attach($owner);
    }

    /**
     * Merge object query with translate query.
     */
    public function beforeFind($event)
    {
        $this->applyTranslateCriteria();
        return true;
    }

    /**
     * @return BaseModel
     */
    public function applyTranslateCriteria()
    {
        return $this->owner;
    }

    /**
     * Apply object translation
     */
    public function afterFind($event)
    {
        $this->applyTranslation();
        return parent::afterFind($event);
    }

    /**
     * Apply translated attrs
     */
    public function applyTranslation()
    {
        $relation = $this->relationName;
        if ($this->owner->$relation) {
            foreach ($this->translateAttributes as $attr) {
                $this->owner->$attr = $this->owner->$relation->{Yii::app()->language};
            }
        }
    }

    /**
     * Update model translations
     */
    /*    public function afterSave($event)
        {
            $relation = $this->relationName;
            $translate = $this->owner->$relation;
            if ($this->owner->isNewRecord OR !$translate)
                $this->insertTranslations();
            else
                $this->updateTranslation($translate);
            return true;
        }*/

    /**
     * Delete model related translations
     */
    /*    public function afterDelete($event)
        {
            $className = $this->owner->translateModelName;
            $className::model()
                ->deleteAll('object_id=:id',array(
                ':id'=>$this->owner->getPrimaryKey()
            ));
            return true;
        }*/

    /**
     * Create new object translation for each language.
     * Used on creating new object.
     */
    /*    public function insertTranslations()
        {
            foreach (Yii::app()->languageManager->languages as $lang)
                $this->createTranslation($lang->id);
        }*/

    /**
     * Create object translation
     * @param int $languageId Language id
     * @return boolean Translation save result
     */
    /*    public function createTranslation($languageId)
        {
            $className = $this->owner->translateModelName;
            $translate = new $className;
            $translate->object_id = $this->owner->getPrimaryKey();
            $translate->language_id = $languageId;

            // Populate translated attributes
            foreach($this->translateAttributes as $attr)
                $translate->$attr = $this->owner->$attr;

            return $translate->save(false);
        }*/

    /**
     * Update "current" translation object
     * @param BaseModel $translate
     */
    /*    public function updateTranslation($translate)
        {
            foreach ($this->translateAttributes as $attr)
                $translate->$attr = $this->owner->$attr;
            $translate->save(false);
        }*/

    /**
     * Get language id to load translated data.
     * @return integer Language id
     */
    /*    public function getTranslateLanguageId()
        {
            return Yii::app()->language;
        }*/

    /**
     * Scope to load translation by language id
     * @param mixed $language or array containing `lang_id` key
     * @return BaseModel
     */
    /*    public function language($language=null)
        {
            if(is_array($language) && isset($language['lang_id']))
                $language = $language['lang_id'];

            if(!Yii::app()->languageManager->getById($language))
                $language = Yii::app()->languageManager->default->id;

            $this->_translation_lang = $language;
            return $this->owner;
        }*/

    /**
     * @return array
     */
    /*    public function getTranslateAttributes()
        {
            return $this->translateAttributes;
        }*/

}