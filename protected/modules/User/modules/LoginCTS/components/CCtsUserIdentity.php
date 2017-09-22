<?php

class CCtsUserIdentity extends CBaseUserIdentity
{
    /**
     * @var object userData
     */
    public $userData;

    /**
     * @var string username
     */
    public $username;

    /**
     * Constructor.
     * @param array $userData userData
     * @param string $username username
     */
    public function __construct($userData, $username)
    {
        $this->userData = $userData;
        $this->username = $username;
    }

    /**
     * Authenticates a user based on {@link privateKey} and {@link passphrase} and {@link certificate}.
     * Derived classes should override this method, or an exception will be thrown.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        throw new CException(Yii::t('yii', '{class}::authenticate() must be implemented.', array('{class}' => get_class($this))));
    }

    /**
     * Returns the unique identifier for the identity.
     * The default implementation simply returns {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return string the unique identifier for the identity.
     */
    public function getId()
    {
        return $this->username;
    }

    /**
     * Returns the display name for the identity.
     * The default implementation simply returns {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return string the display name for the identity.
     */
    public function getName()
    {
        return $this->username;
    }
}