<?php

/**
 * This is the model class for table "adm_ldap_settings".
 *
 * The followings are the available columns in table 'adm_ldap_settings':
 * @property string $id
 * @property string $ldap_host
 * @property string $ldap_port
 * @property string $ldap_dc
 * @property string $ldap_ou
 */
class LdapSettings extends CActiveRecord
{

    public $ldap_username;
    public $synapsis_user;

    public static function GetLdapSettingsList()
    {
        $ldap_settings = array();
        $model = self::model()->findAll();
        foreach ($model as $value) {
            //die(var_dump($value->id));
            $ldap_settings[$value->id] = $value->ldap_host . '-' . $value->ldap_dc;
        }

        return $ldap_settings;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LdapSettings the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getNumberOfLdapSettings()
    {
        $model = self::model()->findAll();
        $count = count($model);
        return $count;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'adm_ldap_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ldap_username,ldap_host, ldap_port, ldap_dc, ldap_ou', 'required'),
            array('ldap_username,ldap_host', 'length', 'max' => 150),
            array('ldap_port', 'length', 'max' => 10),
            array('ldap_dc, ldap_ou', 'length', 'max' => 255),
            array('create_user_id, update_user_id', 'numerical', 'integerOnly' => true),
            array('create_user_id', 'default', 'value' => Yii::app()->user->id, 'on' => 'insert'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ldap_host, ldap_port, ldap_dc, ldap_ou ,ldap_username,create_user_id, create_datetime, update_user_id, update_datetime,synapsis_user', 'safe', 'on' => 'search'),
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
            'user_create' => array(self::BELONGS_TO, 'User', 'create_user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',

            'ldap_host' => Yii::t('mess','ldap_host'),
            'ldap_port' => Yii::t('mess','ldap_port'),
            'ldap_dc' => Yii::t('mess','ldap_dc'),
            'ldap_ou' => Yii::t('mess','ldap_ou'),
            'ldap_username' => Yii::t('mess','ldap_username'),
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
        $criteria->compare('ldap_host', $this->ldap_host, true);
        $criteria->compare('ldap_port', $this->ldap_port, true);
        $criteria->compare('ldap_dc', $this->ldap_dc, true);
        $criteria->compare('ldap_ou', $this->ldap_ou, true);
        //$criteria->compare('ldap_username',$this->ldap_username,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
 * Ldap Settings List
 * @return array
 */

    protected function beforeSave()
    {


        if (parent::beforeSave()) {
            if ($this->isNewRecord) {

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
    * Get all ldap Settings
    * @return int
    */

    protected function afterSave()
    {

//		$profileAdditional = ProfileAdditional::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
//		if ($profileAdditional === null) {
//			$profileAdditional = new ProfileAdditional;
//			$profileAdditional->id = $this->id;
//			$profileAdditional->user_id = $this->id;
//			$profileAdditional->save();
//		}
//		$profile = Profile::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
//		if ($profile === null) {
//			$profile = new Profile;
//			$profile->id = $this->id;
//			$profile->user_id = $this->id;
//			$profile->save();
//		}
//                $settings = UserSettings::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
//                if ($settings === null) {
//                        $settings = new UserSettings();
//                        $settings->id = $this->id;
//                        $settings->user_id = $this->id;
//                        $settings->time_limit =0;
//                        $settings->restricted_id =0;
//                        $settings->save();
//                }
        return true;
    }
}
