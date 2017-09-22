<?php

/**
 * This is the model class for table "adm_user_ldap_relation".
 *
 * The followings are the available columns in table 'adm_user_ldap_relation':
 * @property string $id
 * @property string $user_id
 * @property string $ldap_setting_id
 * @property string $create_user_id
 * @property string $create_datetime
 * @property string $update_user_id
 * @property string $update_datetime
 */
class UserLdapRelation extends CActiveRecord
{

    public $ldap_user;

    public static function getNumberOfUserLdapRelation()
    {
        $model = self::model()->findAll();
        $count = count($model);
        return $count;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserLdapRelation the static model class
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
        return 'adm_ldap_user_relation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, ldap_setting_id, ', 'required'),
            array('user_id, ldap_setting_id, create_user_id, update_user_id', 'length', 'max' => 20),
            array('ldap_user', 'length', 'max' => 50),
            array('update_datetime,ldap_user', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, ldap_setting_id, create_user_id, create_datetime, update_user_id, update_datetime,ldap_user', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'user_create' => array(self::BELONGS_TO, 'User', 'create_user_id'),
            'ldapSetting' => array(self::BELONGS_TO, 'LdapSettings', 'ldap_setting_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => Yii::t('UserModule.t','USER'),
            'ldap_setting_id' => Yii::t('mess','Ldap Setting'),
            'ldap_user' => Yii::t('mess','ldap_username'),
            'synapsis_user' => Yii::t('mess','synapsis_user'),
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
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('ldap_setting_id', $this->ldap_setting_id, true);
        $criteria->compare('create_user_id', $this->create_user_id, true);
        $criteria->compare('create_datetime', $this->create_datetime, true);
        $criteria->compare('update_user_id', $this->update_user_id, true);
        $criteria->compare('update_datetime', $this->update_datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave()
    {


        if (parent::beforeSave()) {
            if ($this->isNewRecord) {

                //die(var_dump($this->ldap_user));
                $this->CheckUpdateLdapUsername($this->user_id, $this->ldap_user);
                $this->create_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->create_datetime = date("Y-m-d H:i:s");

                return true;
            } else {
                $this->update_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->update_datetime = date("Y-m-d H:i:s");
                return true;
            }
        } else {
            return false;
        }

    }

    /*
    * Get all userldap Relation
    * @return int
    */

    private function CheckUpdateLdapUsername($id_user, $ldap_username)
    {
        // User::model()->updateByPk($id_user, array('ad_username' => $ldap_username));

        $model = User::model()->findByPk($id_user);
        $model->ad_username = $ldap_username;
        $model->update(array('ad_username'));


    }
}
