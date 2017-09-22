<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class DbUserIdentity extends CUserIdentity
{
    // Define your Constant(s)
    const ERROR_USERNAME_NOT_ACTIVE = 3;
    const ERROR_WORK_TIME_LIMITED = 4;
    const ERROR_HOLIDAYS_DAYS_NOT_WORKED = 5;
    const LOGIN_METHOD = 1;

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
        $username = strtolower($this->username);
        $user = User::model()->findByAttributes(array('username' => $this->username));

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else if ($user->status_id == 0) {
            $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
        } else if (!UserSettings::checkWorkTime($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_WORK_TIME_LIMITED;
        } else if (!UserSettings::CheckUserEnableHolidays($this->username, self::LOGIN_METHOD)) {
            $this->errorCode = self::ERROR_HOLIDAYS_DAYS_NOT_WORKED;
        } else {
            Yii::app()->getUser()->setState('sa', null);

            if ($user->username === 'sa') {

                $saAccesses = SaAccess::model()->findAll();
                $userHostAddress = Yii::app()->getRequest()->getUserHostAddress();
                $nr = 0;

                foreach ($saAccesses as $value) {
                    $ip = $value->ip;
                    if ($userHostAddress === $ip) {
                        $this->_id = $user->id;
                        $this->setState('id', $user->id);
                        $this->username = $user->username;
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
                $this->username = $user->username;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }
}
