<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdUserIdentity extends CUserIdentity
{
    // Define your Constant(s)
    const ERROR_USERNAME_NOT_ACTIVE = 3;
    const ERROR_WORK_TIME_LIMITED = 4;
    const ERROR_HOLIDAYS_DAYS_NOT_WORKED = 5;
    const ERROR_NOT_SET_CONFIG_LDAP = 6;
    const ERROR_LOGIN_LDAP_INVALID = 7;
    const ERROR_USERNAME_NOT_IN_USER = 8;
    const LOGIN_METHOD = 2;

    private $_id;


    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $ad_username = $this->username;
        $ad_password = $this->password;
        $user = User::model()->findByAttributes(array('ad_username' => $ad_username));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_NOT_IN_USER;
        } elseif ($user->status_id == 0) {
            $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
        } else if (!UserSettings::checkWorkTime($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_WORK_TIME_LIMITED;
        } else if (!UserSettings::CheckUserEnableHolidays($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_HOLIDAYS_DAYS_NOT_WORKED;
        } else {
            $this->_id = $user->id;
            $uldap_relation = UserLdapRelation::model()->findByAttributes(array('user_id' => $this->_id));
            if ($uldap_relation === null) {
                $this->errorCode = self::ERROR_NOT_SET_CONFIG_LDAP;
            } else {
                $ldap = LdapSettings::model()->findByPk($uldap_relation->ldap_setting_id);
                if ($ldap === null) {
                    $this->errorCode = self::ERROR_NOT_SET_CONFIG_LDAP;
                } else {
                    $dc_first = explode('.', $ldap->ldap_dc)[0];
                    if (!AdUserIdentity::bindLdap($ldap->ldap_host, $ldap->ldap_port, $ad_username, $ad_password, $dc_first)) {
                        $this->errorCode = self::ERROR_LOGIN_LDAP_INVALID;
                    } else {
                        $this->_id = $user->id;
                        $this->setState('id', $user->id);
                        Yii::app()->getUser()->setState('__name', $this->username);
                        $this->username = $user->username;
                        $this->errorCode = self::ERROR_NONE;
                    }
                }
            }


        }
        return $this->errorCode == self::ERROR_NONE;

    }

    private static function bindLdap($host, $port, $username, $password, $dc)
    {
        if (!strpos($username, '\\'))
            $username = $dc . '\\' . $username;

        try {

            // connect to ldap server
            $ldapconn = ldap_connect($host, $port)
            or die("Could not connect to LDAP server.");

            // Set some ldap options for talking to
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

            try {
                if ($ldapconn) {

                    // binding to ldap server
                    $ldapbind = @ldap_bind($ldapconn, $username, $password);

                    // verify binding
                    if ($ldapbind) {
                        //echo "LDAP bind successful...\n";
                        return true;
                    } else {
                        //echo "LDAP bind failed...\n";
                        return false;
                    }

                }
            } catch (ErrorException $ex) {
                echo Message("Mesaj :" . $ex->getMessage());
            }
        } catch (ErrorException $ex) {
            echo Message("Mesaj :" . $ex->getMessage());
        }
    }

    /*
     * @return bool if bind ldap
     */

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }

}