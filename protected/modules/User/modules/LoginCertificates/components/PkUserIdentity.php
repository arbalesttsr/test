<?php

/**
 * PkUserIdentity represents the data needed to identity a user by private key.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * @author Victor Martin <vectormartin@gmail.com>
 */
class PkUserIdentity extends CPkUserIdentity
{
    const ERROR_INVALID_CERTIFICATE = 9;
    const ERROR_USERNAME_NOT_ACTIVE = 3;
    const ERROR_WORK_TIME_LIMITED = 4;
    const ERROR_HOLIDAYS_DAYS_NOT_WORKED = 5;
    const LOGIN_METHOD = 3;
    const ERROR_PASSWORD_INVALID_CERT = 11;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */

    private $_id;

    public function authenticate()
    {
        $privateKeyFile = $this->privateKeyFile;
        $privateKeyFilePath = $privateKeyFile->getTempName();
        //$username = strtolower($this->username);
        $user = User::model()->findByAttributes(array('username' => $this->username));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->status_id == 0) {
            $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
        } else if (!UserSettings::checkWorkTime($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_WORK_TIME_LIMITED;
        } else if (!UserSettings::CheckUserEnableHolidays($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_HOLIDAYS_DAYS_NOT_WORKED;
        } else {
            //$certificatesPath        = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
            $certificatesPath = CertSettings::getDefaultConfigCertigicatesPath();
            //$certificatesPath = Yii::app()->getModule('User/LoginCertificates')->openssl['certificatesPath'];

            $certificateName = $user->certificate_path;
            $certificate = openssl_x509_read(file_get_contents($certificatesPath . $certificateName));
            $privateKey = openssl_pkey_get_private('file://' . $privateKeyFilePath, $this->passphrase);
            if (!$privateKey) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID_CERT;
                $this->errorMessage = 'The password is incorrectyyyyyy.';
            } else {
                $auth = openssl_x509_check_private_key($certificate, $privateKey);
                if (!$auth) {
                    $this->errorCode = self::ERROR_INVALID_CERTIFICATE;
                } else {
                    Yii::app()->getUser()->setState('sa', null);

                    if ($user->username === 'sa') {

                        $saAccesses = SaAccess::model()->findAll();
                        $nr = 0;

                        foreach ($saAccesses as $value) {
                            $ip = $value->ip;
                            if (true) { //if ($userHostAddress === $ip) {
                                $this->_id = $user->id;
                                $this->setState('id', $user->id);
                                $this->username = $user->username . '-cert';
                                $this->errorCode = self::ERROR_NONE;
                                Yii::app()->getUser()->setState('sa', User::SA);
                                break;
                            }
                            $nr++;
                            if ($nr > count($saAccesses) - 1)
                                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                        }
                    } else {
                        $this->_id = $user->id;
                        $this->setState('id', $user->id);
                        Yii::app()->getUser()->setState('__name', $this->username);
                        $this->username = $user->username . '-cert';
                        $this->errorCode = self::ERROR_NONE;
                    }
                }
            }
        }

        return !$this->errorCode;
    }


    public function getId()
    {
        return $this->_id;
    }
}