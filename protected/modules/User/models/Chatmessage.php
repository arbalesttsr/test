<?php

/**
 * This is the model class for table "cl_chatmessage".
 *
 * The followings are the available columns in table 'cl_chatmessage':
 * @property string $id
 * @property string $msg
 * @property string $date
 * @property string $from
 * @property string $type
 * @property string $to
 * @property integer $readed
 * @property string $create_user_id
 * @property string $create_datetime
 * @property string $update_user_id
 * @property string $update_datetime
 *
 * The followings are the available model relations:
 * @property AdmUser $from0
 */
class Chatmessage extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Chatmessage the static model class
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
        return Yii::app()->getModule('User')->tablePrefix . '_chatmessage';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('msg, date, from, type', 'required'),
            array('readed', 'numerical', 'integerOnly' => true),
            array('type', 'length', 'max' => 100),
            array('to, create_user_id, create_datetime, update_user_id, update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, msg, date, from, type, to, readed, create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'fromUser' => array(self::BELONGS_TO, 'User', 'from'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'msg' => Yii::t('mess', 'msg'),
            'date' => Yii::t('mess', 'date'),
            'from' => Yii::t('mess', 'from'),
            'type' => Yii::t('mess', 'type'),
            'to' => Yii::t('mess', 'to'),
            'readed' => Yii::t('mess', 'readed'),
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
        $criteria->compare('msg', $this->msg, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('from', $this->from, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('to', $this->to, true);
        $criteria->compare('readed', $this->readed);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('create_datetime', $this->create_datetime, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);
        $criteria->compare('update_datetime', $this->update_datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFormDatafrom()
    {

        return CHtml::listData(User::model()->findAll(), "id", "username");
    }

    public function getFormDatatype()
    {

        return array("1" => "1", "2" => "2",);
    }

    public function formAttributes()
    {

        return array();
    }
}