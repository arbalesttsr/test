<?php

/**
 * This is the model class for table "adm_cert_settings".
 *
 * The followings are the available columns in table 'adm_cert_settings':
 * @property string $id
 * @property string $certificates_path
 * @property string $key_path
 * @property string $openssl_config_path
 * @property string $digest_alg
 * @property string $private_key_bits
 * @property string $private_key_type
 * @property integer $default_id
 */
class CertSettings extends CActiveRecord
{
    //set id settings for default settings
    const DEFAULT_CONFIG = 1;

    public static function getDefaultConfig()
    {
        $model = self::model()->findByAttributes(array('default_id' => 1));

        if ($model) {
            if ($model->private_key_type == 'OPENSSL_KEYTYPE_RSA')
                $model->private_key_type = 0;
            $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');
            $array_conf = array(//'config'=>$realpath.DIRECTORY_SEPARATOR.'data'.$model->openssl_config_path,
                'digest_alg' => $model->digest_alg,
                'private_key_bits' => (int)$model->private_key_bits,
                'private_key_type' => (int)$model->private_key_type,);

            return $array_conf;
        } else {
            return array();
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CertSettings the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getDefaultConfigCertigicatesPath()
    {
        $model = self::model()->findByAttributes(array('default_id' => 1));

        if ($model) {
            $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
            return $realpath . $model->certificates_path;

        } else
            die('errorrrr');
    }

    public static function getDefaultConfigKeysPath()
    {
        $model = self::model()->findByAttributes(array('default_id' => 1));

        if ($model) {
            $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
            return $realpath . $model->key_path;
        } else
            die('errorrrr');
    }

    public static function GetNumberCertificateSettings()
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
        return 'adm_cert_settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('certificates_path,key_path, openssl_config_path', 'required'),
            array('certificates_path,key_path, openssl_config_path', 'length', 'max' => 255),
            array('digest_alg, private_key_type', 'length', 'max' => 100),
            array('private_key_bits, create_user_id, update_user_id,default_id', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, certificates_path,key_path openssl_config_path, digest_alg, private_key_bits, private_key_type,default_id, create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
        );
    }

    /*
     * 'digest_alg'       => 'sha512', // One of the following option: DSA, DSA-SHA, MD2, MD4, MD5, RIPEMD160, SHA, SHA1, SHA224, SHA256, SHA384, SHA512
     *'private_key_bits' => 2048, // Options: 1024, 2048 (recommended), 4096
     *'private_key_type'')
     */

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
            'certificates_path' => Yii::t('mess','certificates_path'),
            'key_path' =>Yii::t('mess','key_path'),
            'openssl_config_path' => Yii::t('mess','openssl_config_path'),
            'digest_alg' => Yii::t('mess','digest_alg'),
            'private_key_bits' => Yii::t('mess','private_key_bits'),
            'private_key_type' => Yii::t('mess','private_key_type'),
            'default_id' => Yii::t('mess','default_id'),
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
        $criteria->compare('certificates_path', $this->certificates_path, true);
        $criteria->compare('key_path', $this->key_path, true);
        $criteria->compare('openssl_config_path', $this->openssl_config_path, true);
        $criteria->compare('digest_alg', $this->digest_alg, true);
        $criteria->compare('private_key_bits', $this->private_key_bits, true);
        $criteria->compare('private_key_type', $this->private_key_type, true);
        $criteria->compare('default_id', $this->default_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function ListDigestAlg()
    {
        return array(
            'DSA' => 'DSA',
            'DSA-SHA' => 'DSA-SHA',
            'MD2' => 'MD2',
            'MD4' => 'MD4',
            'MD5' => 'MD5',
            'RIPEMD160' => 'RIPEMD160',
            'SHA' => 'SHA',
            'SHA1' => 'SHA1',
            'SHA224' => 'SHA224',
            'SHA256' => 'SHA256',
            'SHA384' => 'SHA384',
            'SHA512' => 'SHA512 (recommended)',

            // 'sha512', // One of the following option: DSA, DSA-SHA, MD2, MD4, MD5, RIPEMD160, SHA, SHA1, SHA224, SHA256, SHA384, SHA512
        );
    }

    public function ListPrivateKeyBits()
    {
        return array(
            1024 => '1024',
            2048 => '2048 (recommended)',
            4096 => '4096'
        );
    }

    public function ListPrivateKeyType()
    {
        return array(
            OPENSSL_KEYTYPE_DSA => 'OPENSSL_KEYTYPE_DSA',
            OPENSSL_KEYTYPE_RSA => 'OPENSSL_KEYTYPE_RSA (recommended)',
        );
    }

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
}
