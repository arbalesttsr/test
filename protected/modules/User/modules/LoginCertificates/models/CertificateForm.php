<?php

/**
 * CertificateForm class.
 * CertificateForm is the data structure for keeping
 * user certificate form data. It is used by the 'create' action of 'CertificateController'.
 */
class CertificateForm extends CFormModel
{
    public $layout = 'main';

    public $username;

    //The Distinguished Name to be used in the certificate.
    public $dn = array();
    public $countryName;
    public $stateOrProvinceName;
    public $localityName;
    public $organizationName;
    public $organizationalUnitName;
    public $commonName;
//	public $emailAddress2;
    //public $mailAddress;
    public $emailAddress;
    public $keys;
    //public $privateKey;
    public $certificate;

    public $passphrase;
    public $passphraseCompare;

    // Configurations used for creating private key
    public $configArgs = array();

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */

    public function init()
    {

        $this->configArgs = Yii::app()->getModule('User/LoginCertificates')->openssl['configArgs'];
        $this->dn = Yii::app()->getModule('User/LoginCertificates')->openssl['dn'];
        $this->countryName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['countryName'];
        $this->stateOrProvinceName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['stateOrProvinceName'];
        $this->localityName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['localityName'];
        $this->organizationName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['organizationName'];
        $this->organizationalUnitName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['organizationalUnitName'];
        $this->commonName = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['commonName'];
        //  $this->mailAddress            = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['mailAddress'];
        $this->emailAddress = Yii::app()->getModule('User/LoginCertificates')->openssl['dn']['emailAddress'];

    }

    public function rules()
    {
        return array(
            array('username,passphrase,passphraseCompare,countryName,stateOrProvinceName,localityName,organizationName,organizationalUnitName,commonName,emailAddress', 'required'),
            array('passphrase', 'length', 'max' => 128),
            array('passphraseCompare', 'compare', 'compareAttribute' => 'passphrase'),
            array('countryName', 'length', 'min' => 2, 'max' => 2),
            array('emailAddress', 'email'),
            array('stateOrProvinceName,localityName,organizationName,organizationalUnitName,commonName', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username' => Yii::t('UserModule.t', 'USERNAME'),
            'privateKey' => Yii::t('UserModule.t', 'PRIVATE_KEY'),
            'passphrase' => Yii::t('UserModule.t', 'PASSPHRASE'),
            'passphraseCompare' => Yii::t('UserModule.t', 'REPEAT_PASSPHRASE'),
            'countryName' => Yii::t('UserModule.t', 'COUNTRY_NAME'),
            'stateOrProvinceName' => Yii::t('UserModule.t', 'STATE_OR_PROVINCE_NAME'),
            'localityName' => Yii::t('UserModule.t', 'LOCALITY_NAME'),
            'organizationName' => Yii::t('UserModule.t', 'ORGANIZATION_NAME'),
            'organizationalUnitName' => Yii::t('UserModule.t', 'ORANIZATIONAL_UNIT_NAME'),
            'commonName' => Yii::t('UserModule.t', 'COMMON_NAME'),
            'emailAddress' => Yii::t('UserModule.t', 'EMAIL'),
        );
    }

//	public function setDn()
//	{
//		return $this->dn = array(
//				'countryName'            => $this->countryName,
//				'stateOrProvinceName'    => $this->stateOrProvinceName,
//				'localityName'           => $this->localityName,
//				'organizationName'       => $this->organizationName,
//				'organizationalUnitName' => $this->organizationalUnitName,
//				'commonName'             => $this->commonName,
//				'emailAddress'            => $this->emailAddress
//		);
//	}
//	
//	
//	
//	public function setKeys()
//	{
//           // die(var_dump($this->configArgs));
//            
//		if ($this->configArgs)
//			$keys = openssl_pkey_new($this->configArgs);
//	
//		if ($keys!==false) {
//			$this->keys = $keys;
//			return true;
//		}
//		else
//			return false;
//	}
//	
//	public function createCertificate()
//	{
//            
//		if($this->keys==null)
//			$this->setKeys();
//		$keys = $this->keys;
//		$dn = $this->setDn();
//                
//		$configargs = $this->configArgs;
//                //die(var_dump($keys));
//		$csr = openssl_csr_new($dn, $keys, $configargs);
//		//die(var_dump($csr));
//		$certificate = Yii::app()->getModule('User/LoginCertificates')->openssl['certificatesPath'].User::model()->findByPk($this->username)->username.'.crt';
//		$selfSignedcertificate = openssl_csr_sign($csr, null, $keys, 365, $configargs);
//		
//		$user = User::model()->findByPk($this->username);
//		$user->certificate_path = User::model()->findByPk($this->username)->username.'.crt';
//		$user->update();
//		
//		if (openssl_x509_export_to_file($selfSignedcertificate, $certificate))
//			return true;
//	}
//	
//	public function downloadPrivateKey()
//	{
//		if($this->keys==null)
//			$this->setKeys();
//		$keys = $this->keys;
//		$passphrase = $this->passphrase;
//		$configargs = $this->configArgs;
//		if (openssl_pkey_export($keys, $privateKey, $passphrase, $configargs))
//		
//		$privateKeyFile = User::model()->findByPk($this->username)->username.'.key';
//		file_put_contents($privateKeyFile, $privateKey);
//	
//		if (file_exists($privateKeyFile)) {
//			header('Content-Description: File Transfer');
//			header('Content-Type: application/octet-stream');
//			header('Content-Disposition: attachment; filename='.basename($privateKeyFile));
//			header('Content-Transfer-Encoding: binary');
//			header('Expires: 0');
//			header('Cache-Control: must-revalidate');
//			header('Pragma: public');
//			header('Content-Length: ' . filesize($privateKeyFile));
//			ob_clean();
//			flush();
//			readfile($privateKeyFile);
//			return true;
//			exit();
//		}
//	
//	}

}