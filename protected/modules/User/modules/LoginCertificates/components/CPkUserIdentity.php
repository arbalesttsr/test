<?php

/**
 * CPkUserIdentity provides identification through private key.
 *
 * @package default
 * @author Victor Martin <vectormartin@gmail.com>
 */
class CPkUserIdentity extends CBaseUserIdentity
{
    /**
     * @var object privateKeyFile
     */
    public $privateKeyFile;
    /**
     * @var string passphrase
     */
    public $passphrase;
    /**
     * @var object certificateFile
     */
    public $certificateFile;

    public $username;

    /**
     * Constructor.
     * @param array $privateKeyFile privateKey
     * @param string $passphrase passphrase
     * @param array $certificateFile certificate
     */
    public function __construct($username, $privateKeyFile, $passphrase/* ,$certificateFile */)
    {
        $this->username = $username;
        $this->privateKeyFile = $privateKeyFile;
        $this->passphrase = $passphrase;
        //$this->certificateFile=$certificateFile;
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