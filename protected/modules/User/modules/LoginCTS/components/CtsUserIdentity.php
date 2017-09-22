<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class CtsUserIdentity extends CCtsUserIdentity
{
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

        $idnp = $this->userData['IDNO'];
        $user = User::model()->findByAttributes(array('idnp' => $idnp));
        if ($user === null) {
            $user_new = new User();
            $user_new->username = $this->userData['FirstName'] . '.' . $this->userData['LastName'];
            $user_new->password = '123qweBNM';
            $user_new->passwordCompare = '123qweBNM';
            $user_new->idnp = $this->userData['IDNO'];
            $user_new->status_id = 1;
            if ($user_new->save()) {
                $this->_id = $user_new->id;
                $this->username = $user_new->username . '-cts';
                $this->setState('username', $user_new->username);
                $this->errorCode = self::ERROR_NONE;
            } else
                $this->errorCode = 767898;
        } else {
            $this->_id = $user->id;
            $this->username = $user->username . '-cts';
            $this->setState('username', $user->username);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }


    public function getId()
    {
        return $this->_id;
    }
}