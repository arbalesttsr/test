<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $ad_username
 * @property integer $idnp
 * @property string $certificate_path
 * @property integer $create_user_id
 * @property string $create_datetime
 * @property integer $update_user_id
 * @property string $update_datetime
 *
 * The followings are the available model relations:
 * @property Profile $profile
 * @property ProfileAdditional $profileAdditional
 */
class Client extends CActiveRecord
{

    //status
    const STATUS_BLOCKED =0;
    const STATUS_ACTIVE = 1;


    //admins
    const SA = 'System Administrator';
    const ADMIN = 'admin';
    const SA_ID = '9223372036854775807';
    /**
     * @var string the raw password. Used to collect password input and isn't saved in database
     */
    public $password;
    public $maxColumn;
    public $passwordCompare;
    public $sql_user;
    /**
     * undocumented class variable
     *
     * @var string
     **/
    public $role;
    public $recaptcha;
    //public $profile;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cli_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $clientArray = array(
            //array('role', 'in', 'range'=>Yii::app()->getAuthManager()->getRoles()),
            array('confirmation, regle', 'required', 'on'=>'insert'),


            array('recaptcha', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('recaptcha', 'required'),

            array('confirmation','numerical',
                'integerOnly'=>true,
                'min'=>1,
                'max'=>1,
                'tooSmall'=>'Sistemul așteaptă acordul utilizatorului de creare a unui account nou.',
                'tooBig'=>'Sistemul așteaptă acordul utilizatorului de creare a unui account nou.'),

            array('regle','numerical',
                'integerOnly'=>true,
                'min'=>1,
                'max'=>1,
                'tooSmall'=>'Bifați vă rog politica de confidentialitate.',
                'tooBig'=>'Bifați vă rog politica de confidentialitate.'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('username, ad_username, create_user_id, create_datetime, update_user_id, update_datetime, role, profile,status_id,sql_user,confirmation, regle', 'safe', 'on'=>'search'),
        );


        $userArray = [
            array('username, password, passwordCompare', 'required', 'on'=>'insert'),
            array('username, idnp', 'unique'),
            array('idnp', 'unique'),
            array('idnp', 'required'),
            array('idnp', 'length', 'min'=>8, 'max'=>13),
            array('create_user_id, update_user_id, idnp, status_id,sql_user', 'numerical', 'integerOnly'=>true),
            array('create_user_id', 'default', 'value'=>Yii::app()->user->id, 'on'=>'insert'),
            //array('update_user_id', 'default', 'value'=>Yii::app()->user->id, 'on'=>'update'),
            array('ad_username, role', 'length', 'max'=>45),
            array('password_hash', 'length', 'max'=>128),
            array('username', 'match', 'pattern'=>'/^[a-zA-Z0-9_.\-]{5,45}/i', 'message'=>Yii::t('UserModule.t','USERNAMEMESSAGE')),
            array('password', 'match', 'pattern'=>'/^(?=.{2,}[a-z])(?=.{2,}[A-Z])(?=.{2,}[0-9])[a-zA-Z0-9_!@$%-+]{6,20}/i',
                'message'=>Yii::t('UserModule.t','PASSPHRASEMESSAGE')),
            array('passwordCompare', 'compare', 'compareAttribute'=>'password'),
            array('create_datetime', 'default', 'value'=>date('Y-m-d H:i:s'), 'on'=>'insert'),
            array('certificate_path', 'length', 'max'=>255),
        ];

        if($this->getIsNewRecord() && Yii::app()->getModule('User')->tablePrefix == 'cli')
            return array_merge($clientArray,$userArray);
        else
            return $userArray;
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'profile' => array(self::HAS_ONE, 'ClientProfile', 'user_id'),
//            'user0' => array(self::BELONGS_TO, 'User', 'create_user_id'),
//            'user1' => array(self::BELONGS_TO, 'User', 'update_user_id'),
            'serviceAccesses' => array(self::HAS_MANY, 'ServiceAccess', 'user_id'),

            'profileAdditional' => array(self::HAS_ONE, 'ClientProfileAdditional', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'              => 'ID',
            'username'        => Yii::t('UserModule.t','USERNAME'),
            'ad_username'     => Yii::t('UserModule.t','AD_USERNAME'),
            'idnp'            => Yii::t('UserModule.t','IDNP'),
            'recaptcha'       => Yii::t('UserModule.t','RECAPTCHA'),
            'confirmation'    => Yii::t('UserModule.t','confirmation'),
            'regle'           => Yii::t('UserModule.t','regle'),
            'password'        => Yii::t('UserModule.t','PASSWORD'),
            'passwordCompare' => Yii::t('UserModule.t','REPEAT_PASSWORD'),
            'create_user_id'  => Yii::t('mess', 'create_user_id'),
            'create_datetime' => Yii::t('mess', 'create_datetime'),
            'update_user_id'  => Yii::t('mess', 'update_user_id'),
            'update_datetime' => Yii::t('mess', 'update_datetime'),
        );
    }

    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password_hash);
    }


    protected function beforeSave() {

        if(parent::beforeSave()) {
            if($this->isNewRecord && !empty($this->password)) {
                if(HelperCheckDB::CheckDbConnectionTypeMysql())
                {
                    $newId  = $this->getMaxId()+1;
                    $this->setPrimaryKey($newId);
                    $this->status_id = 1;
                }

                $this->create_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->create_datetime = date("Y-m-d H:i:s");
                $this->password_hash = CPasswordHelper::hashPassword($this->password);

                return true;
            }
            else {
                $this->update_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->update_datetime = date("Y-m-d H:i:s");
                return true;
            }
        }
        else {
            return false;
        }

    }

    protected function afterSave() {

        $profileAdditional = ClientProfileAdditional::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
        if ($profileAdditional === null) {
            $profileAdditional = new ClientProfileAdditional;
            $profileAdditional->id = $this->id;
            $profileAdditional->user_id = $this->id;
            $profileAdditional->save();
        }
        $profile = ClientProfile::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
        if ($profile === null) {
            $profile_new = new ClientProfile();
            $profile_new->id = $this->id;
            $profile_new->user_id = $this->id;
            if(isset($_POST['ClientProfile'])){
                $profile_new->email = $_POST['ClientProfile']['email'];
                $profile_new->firstname = $_POST['ClientProfile']['firstname'];
                $profile_new->lastname = $_POST['ClientProfile']['lastname'];
                $profile_new->mobile = $_POST['ClientProfile']['mobile'];
            }
            else {
                $profile_new->email = $this->username.'@admin.com';
                $firstname = 'Not Set';
                $lastname = 'Not Set';
                $usr_explode = explode('.', $this->username);
                if (count($usr_explode) > 1) {
                    $firstname = $usr_explode[0];
                    $lastname = $usr_explode[1];
                }
                $profile_new->firstname = $firstname;
                $profile_new->lastname = $lastname;
            }
            $profile_new->idnp = !is_null($this->idnp)? $this->idnp : mt_rand(1000000000000,9999999999999);

            if($profile_new->validate())
            {
                $profile_new->save();
            }
            else
            {
                $errors = $profile_new->getErrors();
//                echo "<pre>";var_dump($errors);echo "</pre>";die();
                $profile_new->addError('email', $profile_new->email);
//                die(var_dump($errors)); //or print_r($errors)
            }
        }
        $settings = ClientSettings::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
        if ($settings === null) {
            $settings = new ClientSettings();
            $settings->id = $this->id;
            $settings->user_id = $this->id;
            $settings->time_limit =0;
            $settings->restricted_id =0;
            $settings->save();
        }
        return true;
    }

    protected function afterDelete()
    {
        $profile = ClientProfile::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
        if ($profile) {
            $profile->delete();
        }
        $profileAdditional = ClientProfileAdditional::model()->find('user_id=:user_id', array(':user_id'=>$this->id));
        if ($profileAdditional) {
            $profileAdditional->delete();
        }
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

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('ad_username',$this->ad_username,true);
        $criteria->compare('idnp',$this->idnp,true);
        $criteria->compare('status_id',$this->status_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getFull_name() {
        $_full_name = $this->profile->firstname . ' ' . $this->profile->lastname . ' ' . $this->profile->patronymic;
        if(trim($_full_name) == '')
            return $this->username;
        return $_full_name;
    }

    public static function generateRandomPassword($length = 9)
    {
        $count_numbers = $count_uppers = ceil($length / 3);
        $count_lowers = $length - $count_numbers - $count_uppers;
        $chars_uppers = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chars_lowers = 'abcdefghijklmnopqrstuvwxyz';
        $chars_numbers = '0123456789';
        $string  = substr(str_shuffle($chars_uppers), 0, $count_uppers);
        $string .= substr(str_shuffle($chars_lowers), 0, $count_lowers);
        $string .= substr(str_shuffle($chars_numbers), 0, $count_numbers);
        return str_shuffle($string);
    }

    public static function GetDbSqlUsername($username)
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = 'client';
        //$transaction=Yii::app()->db->beginTransaction();
        try {
            $sql_username = $tablePrefix . '_' . AP_DB_NAME;
            $user_table = Yii::app()->db->createCommand()
                ->select('usename')
                ->from('pg_catalog.pg_user u')
                ->where('usename=:usename', array(':usename' => $sql_username))
                ->queryRow();
            if ($user_table) {
                // $transaction->commit();
                return $sql_username;
            } else {
                return 'Not Set';
            }

        } catch (Exception $e) {
            //$transaction->rollback();
            return 'Not Set';
        }
    }

    /**
     * @return array of all available roles
     */
    public function getRoles($userId = null)
    {
        $auth = Yii::app()->getAuthManager();

        $roles = array_keys($auth->getRoles($userId));

        $childrenRoles = array();
        if (!empty($roles)) {
            foreach ($roles as $roleName) {
                $childrenRoles[$roleName] = $this->getChildrenRoles($roleName);
            }
        }
        $prefixedRoles = array();
        if ($userId) {
            foreach ($childrenRoles as $role => $children) {
                $prefixedRoles[$role] = $this->prefixify($children, '-- ');
            }
        } else {
            $roles = array();
            foreach ($childrenRoles as $role => $children) {
                $isChild = $this->isChild($role);
                if ($isChild) {
                    unset($childrenRoles[$role]);
                    continue;
                }
                $roles[] = $role;
                if (!empty($children)) {
                    $roles[$role] = $children;
                } else {
                    unset($roles[$role]);
                }
            }
            $prefixedRoles[User::SA] = $this->prefixify($roles, '-- ');
        }

        return $prefixedRoles;
    }

    public function getChildrenRoles($roleName)
    {
        return $this->getItemsHierarchy($roleName, CAuthItem::TYPE_ROLE);
    }
    protected function getItemsHierarchy($itemName, $type)
    {
        $items = array();
        $auth = Yii::app()->getAuthManager();
        $children = $auth->getItemChildren($itemName);
        foreach ($children as $child) {
            if ($child->getType() === $type) {
                $items[] = $child->getName();
                $hasChildren = $this->hasChildren($child->getName());
                if ($hasChildren) {
                    $items[$child->getName()] = $this->getItemsHierarchy($child->getName(), $type);
                } else {
                }
            }
        }
        return $items;
    }

    public function hasChildren($parent)
    {
        return Yii::app()->db->createCommand()
            ->select('parent')
            ->from(Yii::app()->getAuthManager()->itemChildTable)
            ->where('parent=:parent', array(':parent' => $parent))
            ->queryScalar() !== false;
    }

    public function isChild($itemName)
    {
        return Yii::app()->db->createCommand()
            ->select('child')
            ->from(Yii::app()->getAuthManager()->itemChildTable)
            ->where('child=:child', array(':child' => $itemName))
            ->queryScalar() !== false;
    }

    /**
     * @return array(
     *            '-- operator',
     *            '-- -- operator1',
     *            '-- -- -- operator11'
     *            '-- -- -- -- operator111'
     *            '-- -- operator2',
     *            '-- -- -- operator21',
     *            '-- -- -- -- operator211'
     * );
     */

    public function prefixify($elements, $prefix)
    {
        $roles = array();
        foreach ($elements as $key => $value) {
            if (!is_array($value)) {
                $roles = array_merge($roles, array($prefix . $value));
            }
            if (is_array($value)) {
                $roles = array_merge($roles, $this->prefixify($value, '---' . $prefix));
            }
        }
        $rolesUnprefixed = str_replace(array(' ', '-'), '', $roles);
        if (count($rolesUnprefixed) > 0 || count($roles) > 0)
            $roles = array_combine($rolesUnprefixed, $roles);
        return $roles;
    }

    /*
     * User List
     * @return array
     */

    public function getUserStatusText()
    {
        $userStatus = $this->getUserStatus();
        return isset($userStatus[$this->status_id]) ?
            $userStatus[$this->status_id] : "unknown status({$this->status_id})";
    }

    /*
     * Get all users by role
     * @return array
     */

    public function getUserStatus()
    {
        return array(

            self::STATUS_ACTIVE => "Activ",
            self::STATUS_BLOCKED => "Blocat"
        );
    }

    public function getRecoveryPassTime()
    {
        if ($this->penalization == '')
            return 0;
        $penalization = json_decode($this->penalization, 1);
        if (!is_array($penalization))
            return 0;
        if (!isset($penalization['next_recovery_password']))
            return 0;
        $last_recovery_password = $penalization['next_recovery_password'];
        //return round(strtotime("now")-$last_recovery_password);
        if (round(strtotime("now") - $last_recovery_password) < 0)
            return round(abs($last_recovery_password - strtotime("now")) / 60);
        return 0;
    }

}