<?php

/**
 * This is the model class for table "cl_holidays".
 *
 * The followings are the available columns in table 'cl_holidays':
 * @property string $id
 * @property string $holiday_date
 * @property string $description
 * @property string $create_user_id
 * @property string $create_datetime
 * @property string $update_user_id
 * @property string $update_datetime
 */
class Holidays extends CActiveRecord
{
    public static function GetListaDatesHolidays()
    {
        $model = Holidays::model()->findAll();
        $list = array();
        if (!is_null($model)) {
            foreach ($model as $md) {
                $list [] .= $md->holiday_date;
            }
        }
        return $list;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Holidays the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return Yii::app()->getModule('User')->tablePrefix . '_holidays';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('holiday_date', 'required'),
            array('description', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'length', 'max' => 20),
            array('create_datetime, update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, holiday_date, description, create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'holiday_date' => Yii::t('mess', 'holiday_date'),
            'description' => Yii::t('mess', 'description'),
            'create_user_id' => Yii::t('mess', 'create_user_id'),
            'create_datetime' => Yii::t('mess', 'create_datetime'),
            'update_user_id' => Yii::t('mess', 'update_user_id'),
            'update_datetime' => Yii::t('mess', 'update_datetime'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('holiday_date', $this->holiday_date, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('create_datetime', $this->create_datetime, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);
        $criteria->compare('update_datetime', $this->update_datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function formAttributes()
    {

        return array(

            'holiday_date' => array('type' => 'DateTime', 'data_type' => 'DATE', 'visible' => 'public', 'tab' => 'Tab Principal',),
            'description' => array('type' => 'TextField', 'visible' => 'public', 'tab' => 'Tab Principal',),
        );
    }

    /**
     *
     * @return boolean
     */
    protected function beforeSave()
    {
        // die(var_dump($this->holiday_enable));
        if ($this->isNewRecord) {
            $this->create_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
            $this->create_datetime = date("Y-m-d H:i:s");
            return true;
        } else {
            $this->update_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
            $this->update_datetime = date("Y-m-d H:i:s");
            return true;
        }
        return parent::beforeSave();
    }
}