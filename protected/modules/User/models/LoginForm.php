<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    const DataBase_Login = 1; // through DataBase
    const ActiveDirectory_Login = 2;
    const Certificate_Login = 3;
    const CTS_Login = 4;

    const RUN_AS_USER = 0;
    const RUN_AS_CLIENT = 1;

    public $loginMethod;
    public $username;
    public $password;
    public $rememberMe;
    public $privateKeyFile;
    public $runAs;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username,password', 'required'),
            // rememberMe needs to be a boolean
            array('username', 'length', 'max' => 45),
            array('password', 'length', 'max' => 128),
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            array('privateKeyFile, runAs', 'safe'),
            array('loginMethod', 'in', 'range' => array(self::DataBase_Login, self::ActiveDirectory_Login, self::Certificate_Login, self::CTS_Login)),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe' => Yii::t('UserModule.t', 'REMEMBER_ME'),
            'loginMethod' => Yii::t('UserModule.t', 'LOGIN_METHOD'),
            'username' => Yii::t('UserModule.t', 'USERNAME'),
            'password' => Yii::t('UserModule.t', 'PASSWORD'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        //die(var_dump($this->_identity));
        if (!$this->hasErrors()) {

            $this->_identity = $this->getUserIdentity($this->loginMethod, $this->username, $this->password);
            if (!$this->_identity->authenticate()) {
                //die(var_dump($this->_identity->errorCode));
                if (($this->_identity->errorCode == 1) or ($this->_identity->errorCode == 2)) {
                    User::addPenalization($this->username);
                    $this->addError('password', Yii::t('zii', 'Invalid Username or Password'));
                } elseif ($this->_identity->errorCode == 3)
                    $this->addError('username', Yii::t('zii', 'User is currently not active'));
                elseif ($this->_identity->errorCode == 4)
                    $this->addError('username', Yii::t('zii', 'Work time limited for this user'));
                elseif ($this->_identity->errorCode == 5)
                    $this->addError('username', Yii::t('zii', 'User cannot login when holiday day'));
                elseif ($this->_identity->errorCode == 6)
                    $this->addError('username', Yii::t('zii', 'Not set ldap config for this user'));
                elseif ($this->_identity->errorCode == 7)
                    $this->addError('username', Yii::t('zii', 'Ldap login failed'));
                elseif ($this->_identity->errorCode == 8)
                    $this->addError('username', Yii::t('zii', 'Not found this ldap username in users'));
                elseif ($this->_identity->errorCode == 9)
                    $this->addError('username', Yii::t('zii', 'Invalid Certificate'));
                elseif ($this->_identity->errorCode == 11)
                    $this->addError('password', Yii::t('zii', 'Invalid Password Phrase Certificate'));
                else
                    $this->addError('username', Yii::t('zii', 'Invalid Exception'));
            }

//			if(!$this->_identity->authenticate())
//                        {
//                            var_dump($this->_identity->errorMessage);
//                                User::addPenalization($this->username);
//				$this->addError('password','Incorrect username or password.');
//                        }
        }
    }

    private function getUserIdentity($loginMethod)
    {
        switch ($loginMethod) {
            case self::DataBase_Login:
                return new DbUserIdentity($this->username, $this->password);
                break;
            case self::ActiveDirectory_Login:
                return new AdUserIdentity($this->username, $this->password);
                break;
            case self::Certificate_Login:
                return new PkUserIdentity($this->username, $this->privateKeyFile, $this->password);
                break;
            default:
                return new UserIdentity($this->username, $this->password);
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = $this->getUserIdentity($this->loginMethod);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            if (UserSettings::getUserRestrictedLeftMinute($this->username) !== 0)
                $duration = UserSettings::getUserRestrictedLeftMinute($this->username);
            else
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days

            //die(var_dump($duration));
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

    public function ctsLogin($userData)
    {
        if ($this->_identity === null) {
            $this->_identity = new CtsUserIdentity($userData, '');
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity);
            return true;
        } else
            return false;
    }

    public function getLoginMethods2()
    {
        return super_unique(Yii::app()->getModule('User')->loginMethods);
        //return Yii::app()->getModule('User')->loginMethods;
    }

    public function getLoginMethods3($methods = [])
    {
        $loginMethods = super_unique(Yii::app()->getModule('User')->loginMethods);
        $requiredMethods = [];
        foreach($loginMethods as $keyMethod => $loginMethod)
            if(in_array($keyMethod, $methods))
                $requiredMethods[$keyMethod] = $loginMethod;
        return $requiredMethods;
        //return Yii::app()->getModule('User')->loginMethods;
    }

    private function super_unique($array)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        foreach ($result as $key => $value) {
            if (is_array($value)) {
                $result[$key] = super_unique($value);
            }
        }

        return $result;
    }
}
