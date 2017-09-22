<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    // Define your Constant(s)
    const ERROR_USERNAME_NOT_ACTIVE = 3;
    const ERROR_WORK_TIME_LIMITED = 4;
    const ERROR_HOLIDAYS_DAYS_NOT_WORKED = 5;
    const LOGIN_METHOD = 1;

    private $_id;
    public function getId()
    {
        return $this->_id;
    }
}
