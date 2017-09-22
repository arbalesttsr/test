<?php

/**
 * This is the model class for table "adm_cts_settings".
 *
 * The followings are the available columns in table 'adm_cts_settings':
 * @property string $id
 * @property string $key
 * @property string $certificate
 * @property string $validate_response_key
 * @property string $callback_url
 * @property string $login_url
 * @property string $asserationNS
 * @property string $prefix
 * @property string $issuer
 * @property string $key_path
 * @property string $certificate_path
 * @property string $v_responsekey_path
 * @property string $is_default
 * @property string $create_user_id
 * @property string $create_datetime
 * @property string $update_user_id
 * @property string $update_datetime
 */
class CtsSettings extends CActiveRecord
{
    public static function getCtsSettingDefault()
    {
        $model = self::model()->findByAttributes(array('is_default' => 1));

        if ($model)
            return $model;
        else {
            return '';
        }
    }

    public static function GetSiteDefaultMpass()
    {
        return array(
            'https://testmpass.gov.md/login/saml' => 'Testing (https://testmpass.gov.md/login/saml)',
            'https://mpass.gov.md/login/saml' => 'Production (https://mpass.gov.md/login/saml)',
            'https://testmpass.gov.md/logout/saml' => 'Testing (https://testmpass.gov.md/logout/saml)',
            'https://mpass.gov.md/logout/saml' => 'Production (https://mpass.gov.md/logout/saml)',
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'adm_cts_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('key, certificate, validate_response_key,callback_url, login_url, asserationNS, prefix,issuer', 'required'),
            array('key, certificate, validate_response_key', 'file', 'allowEmpty' => true, 'safe' => true, 'maxSize' => 1024 * 1024 * 2, // 2MB 'required'),
                'tooLarge' => 'The file was larger than 2MB. Please upload a smaller file.',),
            array('callback_url, login_url, asserationNS, prefix,issuer', 'length', 'max' => 255),
            array('is_default,create_user_id, create_datetime, update_user_id, update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, key, certificate, validate_response_key, callback_url, login_url, asserationNS, prefix,issuer,is_default,create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
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
            'key' => Yii::t('mess','key'),
            'certificate' => Yii::t('mess','certificate'),
            'validate_response_key' => Yii::t('mess','validate_response_key'),
            'callback_url' => Yii::t('mess','callback _url'),
            'login_url' => Yii::t('mess','login_url'),
			'logout_url' => Yii::t('mess','logout_url'),
            'asserationNS' => Yii::t('mess','asserationNs'),
            'prefix' => Yii::t('mess','prefix'),
            'issuer' => Yii::t('mess','issuer'),
//                        'key_path'=>'Key Path',
//                        'certificate_path' =>'Certificate Path',
//                        'v_responsekey_path'=>'Validate Response Key Path',
            'is_default' => Yii::t('mess','is_default'),
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
        $criteria->compare('key', $this->key, true);
        $criteria->compare('certificate', $this->certificate, true);
        $criteria->compare('validate_response_key', $this->validate_response_key, true);
        $criteria->compare('callback_url', $this->callback_url, true);
        $criteria->compare('login_url', $this->login_url, true);
        $criteria->compare('asserationNS', $this->asserationNS, true);
        $criteria->compare('prefix', $this->prefix, true);
        $criteria->compare('issuer', $this->issuer, true);
//		$criteria->compare('key_path',$this->key_path,true);
//		$criteria->compare('certificate_path',$this->certificate_path,true);
//		$criteria->compare('v_responsekey_path',$this->v_responsekey_path,true);
        $criteria->compare('is_default', $this->is_default, true);
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
                $this->CheckIsDefault($this->is_default);
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

    private function CheckIsDefault($is_default)
    {

        if ($is_default == 1) {
            self::model()->updateAll(array('is_default' => 0));
        }

    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CtsSettings the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
