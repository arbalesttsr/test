<?php

/**
 * This is the model class for table "adm_cert_certificate_info".
 *
 * The followings are the available columns in table 'adm_cert_certificate_info':
 * @property string $id
 * @property string $user_id
 * @property string $country_name
 * @property string $state_or_province_name
 * @property string $locality_name
 * @property string $organization_name
 * @property string $organizational_unit_name
 * @property string $common_name
 * @property string $email_address
 * @property string $passphrase
 * @property string $cert_crt
 * @property string $cert_key
 */
class CertCertificateInfo extends CActiveRecord
{


    public $layout = 'main';

    public $username;

    //The Distinguished Name to be used in the certificate.
    public $dn = array();
    public $keys;
    public $certificate;
    public $passphraseCompare;
    public $configArgs = array();
    // Configurations used for creating private key
    private $real_path;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CertCertificateInfo the static model class
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
        return Yii::app()->getModule('User')->tablePrefix . '_cert_certificate_info';
    }

    public function init()
    {
        $this->real_path = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
        $this->configArgs = CertSettings::getDefaultConfig();
//                //die(var_dump($this->configArgs ));
//		//$this->configArgs             = Yii::app()->getModule('User/LoginCertificates')->openssl['configArgs'];
//		$this->dn                     = Yii::app()->getModule('User/LoginCertificates')->openssl['dn'];
//		$this->countryName            = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['countryName'];
//		$this->stateOrProvinceName    = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['stateOrProvinceName'];
//		$this->localityName           = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['localityName'];
//		$this->organizationName       = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['organizationName'];
//		$this->organizationalUnitName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['organizationalUnitName'];
//		$this->commonName             = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['commonName'];
//              //  $this->mailAddress            = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['mailAddress'];
//                $this->emailAddress           = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['emailAddress'];
//
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, country_name, state_or_province_name, locality_name, organization_name, organizational_unit_name, common_name, email_address, passphrase,passphraseCompare', 'required'),
            array('user_id,create_user_id,update_user_id', 'length', 'max' => 20),
            array('country_name', 'length', 'max' => 3),
            array('passphraseCompare', 'compare', 'compareAttribute' => 'passphrase'),
            array('state_or_province_name, locality_name, organization_name, organizational_unit_name, common_name, email_address', 'length', 'max' => 255),
            array('passphrase', 'length', 'max' => 100),
            array('email_address', 'email'),
            array('cert_crt, cert_key,', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, country_name, state_or_province_name, locality_name, organization_name, organizational_unit_name, common_name, email_address, passphrase, cert_crt, cert_key,create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
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
            'country_name' => Yii::t('UserModule.t','COUNTRY_NAME'),
            'state_or_province_name' => Yii::t('UserModule.t','STATE_OR_PROVINCE_NAME'),
            'locality_name' => Yii::t('UserModule.t','LOCALITY_NAME'),
            'organization_name' => Yii::t('UserModule.t','ORGANIZATION_NAME'),
            'organizational_unit_name' => Yii::t('UserModule.t','ORANIZATIONAL_UNIT_NAME'),
            'common_name' => Yii::t('UserModule.t','COMMON_NAME'),
            'email_address' => Yii::t('UserModule.t','EMAIL'),
            'passphrase' => Yii::t('UserModule.t','PASSPHRASE'),
            'passphraseCompare' => Yii::t('UserModule.t', 'REPEAT_PASSPHRASE'),
            'cert_crt' => Yii::t('mess','Cert Crt'),
            'cert_key' => Yii::t('mess','Cert Key'),
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
        $criteria->compare('country_name', $this->country_name, true);
        $criteria->compare('state_or_province_name', $this->state_or_province_name, true);
        $criteria->compare('locality_name', $this->locality_name, true);
        $criteria->compare('organization_name', $this->organization_name, true);
        $criteria->compare('organizational_unit_name', $this->organizational_unit_name, true);
        $criteria->compare('common_name', $this->common_name, true);
        $criteria->compare('email_address', $this->email_address, true);
        $criteria->compare('passphrase', $this->passphrase, true);
        $criteria->compare('cert_crt', $this->cert_crt, true);
        $criteria->compare('cert_key', $this->cert_key, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function generateCertificateCRT()
    {
        try {
            if ($this->keys == null)
                $this->setKeys();


            $keys = $this->keys;
            $dn = $this->setDn();
            $configargs = $this->configArgs;
            //die(var_dump($keys,$configargs,$dn));
            $csr = openssl_csr_new($dn, $keys, $configargs);
            //$realpath =  realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
            $certificate = CertSettings::getDefaultConfigCertigicatesPath() . User::model()->findByPk($this->user_id)->username . '.crt';
            //die($certificate);
            $selfSignedcertificate = openssl_csr_sign($csr, null, $keys, 365, $configargs);
            $user = User::model()->findByPk($this->user_id);
            $user->certificate_path = $user->username . '.crt';
            $user->update(array('certificate_path'));

            if (openssl_x509_export_to_file($selfSignedcertificate, $certificate))
                return true;
            else {
                return false;
            }
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function setKeys()
    {
        // die(var_dump($this->configArgs));

        if ($this->configArgs) {
            $res = openssl_pkey_new($this->configArgs);
            //$privkey = openssl_pkey_new();
            //$privkey= openssl_pkey_export($res, $privKey);
//                    while (($e = openssl_error_string()) !== false)
//                    { print($e . "<BR>");
//                    }
//                    die(var_dump($this->configArgs,$privkey));
//			$keys = openssl_pkey_new($this->configArgs);
        }
        if ($res !== false) {
            $this->keys = $res;//$keys;
            return true;
        } else
            return false;
    }

    public function setDn()
    {
        return $this->dn = array(
            'countryName' => $this->country_name,
            'stateOrProvinceName' => $this->state_or_province_name,
            'localityName' => $this->locality_name,
            'organizationName' => $this->organization_name,
            'organizationalUnitName' => $this->organizational_unit_name,
            'commonName' => $this->common_name,
            'emailAddress' => $this->email_address
        );
    }

//	public function createCertificate()
//	{
//            
//		if($this->keys==null)
//			$this->setKeys();
//		$keys = $this->keys;
//		$dn = $this->setDn();
//                
//		$configargs = $this->configArgs;
//                //die(var_dump($configargs));
//		$csr = openssl_csr_new($dn, $keys, $configargs);
//		//die(var_dump($csr));
//               // $realpath =  realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
//                //die(var_dump($realpath.  CertSettings::getDefaultConfigCertigicatesPath()));
//                $certificate = $this->real_path.  CertSettings::getDefaultConfigCertigicatesPath().User::model()->findByPk($this->user_id)->username.'.crt';
//		//$certificate = Yii::app()->getModule('User/LoginCertificates')->openssl['certificatesPath'].User::model()->findByPk($this->username)->username.'.crt';
//		$selfSignedcertificate = openssl_csr_sign($csr, null, $keys, 365, $configargs);
////		
////		$user = User::model()->findByPk($this->user_id);
////		$user->certificate_path = User::model()->findByPk($this->user_id)->username.'.crt';
////		$user->update();
//                $user = User::model()->findByPk($this->user_id);
//                $user->certificate_path = $user->username.'crt';
//                $user->update(array('certificate_path'));
//		
//		if (openssl_x509_export_to_file($selfSignedcertificate, $certificate))
//			return true;
//	}

    public function generateCertificateKEY()
    {
        if ($this->keys == null)
            $this->setKeys();
        $keys = $this->keys;
        $passphrase = $this->passphrase;
        $configargs = $this->configArgs;
        if (openssl_pkey_export($keys, $privateKey, $passphrase, $configargs))

            $privateKeyFile = CertSettings::getDefaultConfigKeysPath() . User::model()->findByPk($this->user_id)->username . '.key';
        file_put_contents($privateKeyFile, $privateKey);

        if (file_exists($privateKeyFile)) {
            return $privateKey;
        } else {
            return 'none';
        }
    }

    public function downloadPrivateKey($name)
    {

        $privateKeyFile = CertSettings::getDefaultConfigKeysPath() . $name . '.key';
        // die(var_dump($privateKeyFile));
        if (file_exists($privateKeyFile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($privateKeyFile));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($privateKeyFile));
            ob_clean();
            flush();
            readfile($privateKeyFile);
            return true;
            exit();
        }
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
