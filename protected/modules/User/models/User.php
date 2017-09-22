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
class User extends CActiveRecord
{

    //status
    const STATUS_BLOCKED = 0;
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

    //public $profile;

    /**
     * Generates a random key. The key may contain uppercase and lowercase latin letters, digits, underscore, dash and dot.
     * @param integer $length the length of the key that should be generated
     * @return string the generated random key
     */
    public static function generateRandomKey($length = 32)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $key = strtr(base64_encode(openssl_random_pseudo_bytes($length, $strong)), '+/=', '_-.');
            if ($strong) {
                return substr($key, 0, $length);
            }
        }
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-.';
        return substr(str_shuffle(str_repeat($chars, 5)), 0, $length);
    }

    public static function getUserPenalization($username)
    {//die("adasd");
        $user = User::model()->findByAttributes(array('username' => $username));
        if ($user) {
            $penalization = $user->penalization;
            if ($penalization !== '') {
                $penalization = json_decode($penalization, 1);
                //die(var_dump($penalization));
                if (is_array($penalization)) {
                    $date_pen = isset($penalization['login_error_date']) ? $penalization['login_error_date'] : strtotime("-1 minute");
                    $errs_pen = isset($penalization['login_error_count']) ? $penalization['login_error_count'] : 0;
                    //die(var_dump(is_numeric($date_pen) && round(strtotime("now") - $date_pen) > 0));
                    if (is_numeric($date_pen) && round(strtotime("now") - $date_pen) > 0) {
                        //$user->penalization = json_encode(array('date'=>$date_pen, 'errs'=>$errs_pen));
                        $errs_pen = 0;
                        $user->penalization = null;
                        $user->update();
                    }
                    //die(var_dump($date_pen > strtotime("now"), (int)($penalization['errs']) > 2));
                    return (int)($errs_pen) > 4 ? round(abs($date_pen - strtotime("now")) / 30) : 0;
                }
            }
        }
        return 0;
    }

    public static function addPenalization($username, $nr = 1)
    {
        $user = User::model()->findByAttributes(array('username' => $username));
        if ($user) {
            $penalization = $user->penalization;
            $errs_pen = 0;
            if ($penalization !== '') {
                $penalization = json_decode($penalization, 1);
                if (is_array($penalization)) {
                    $errs_pen = isset($penalization['login_error_count']) ? $penalization['login_error_count'] : 0;
                }
            }
            if ($errs_pen < 5) {
                $penalization['login_error_date'] = strtotime("+30 minutes");
                $penalization['login_error_count'] = $errs_pen + $nr;
                $user->penalization = json_encode($penalization);
                $user->update();
            }
        }
    }

    public static function generateRandomPassword($length = 9)
    {
        $count_numbers = $count_uppers = ceil($length / 3);
        $count_lowers = $length - $count_numbers - $count_uppers;
        $chars_uppers = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chars_lowers = 'abcdefghijklmnopqrstuvwxyz';
        $chars_numbers = '0123456789';
        $string = substr(str_shuffle($chars_uppers), 0, $count_uppers);
        $string .= substr(str_shuffle($chars_lowers), 0, $count_lowers);
        $string .= substr(str_shuffle($chars_numbers), 0, $count_numbers);
        return str_shuffle($string);
    }

    public static function getCurrentUserRoles()
    {
        return User::model()->getRoles(Yii::app()->user->id);
    }
//public function newsearch(){
//$query = "SELECT * FROM cli_user";
//$count=Yii::app()->db->createCommand($query)->queryScalar();
//$dataProvider = new CSqlDataProvider($query, array(
//         'totalItemCount'=>$count));
//     return $dataProvider->getData();
//}

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

    public function isChild($itemName)
    {
        return Yii::app()->db->createCommand()
            ->select('child')
            ->from(Yii::app()->getAuthManager()->itemChildTable)
            ->where('child=:child', array(':child' => $itemName))
            ->queryScalar() !== false;
    }

    public static function verifyStatus($username)
    {
        $user = User::model()->findByAttributes(array('username' => $username));
        if ($user) {
            $status = $user->status_id;

            return (int)$status;
        } else
            return 0;
    }

    public static function getAllUsersRegistered()
    {
        $model = self::model()->findAll();
        $count = count($model);
        return $count;
    }

    public static function getAllUsersBlocked()
    {
        $model = self::model()->findAllByAttributes(array('status_id' => 0));
        $count = count($model);
        return $count;
    }

    public static function getAllUsersWithCertificates()
    {
        $model = self::model()->findAll('certificate_path is not null');
        $nr = 0;
        if ($model) {
            foreach ($model as $value) {
                $nr++;
            }
            return $nr;
        } else {
            return $nr;
        }
    }

    public static function checkHolidayDay()
    {

        try {
            $dates = array();
            $holidays = Holidays::model()->findAll();
            if ($holidays) {

                foreach ($holidays as $value) {
                    $dates [] += $value->holiday_date;
                }

                if (in_array(date('Y-m-d'), $dates)) {
                    return false;
                } else
                    return true;
            } else
                return true;

        } catch (Exception $ex) {
            throw new CHttpException(404, $ex);
        }
    }

    public static function GetUsersList()
    {
        $users = array();
        $model = User::model()->findAll();
        foreach ($model as $value) {
            //die(var_dump($value->id));
            $users[$value->id] = $value->username;
        }

        return $users;
    }

    public static function getAllUsersByRole($role = 'admin')
    {
        $auth = Yii::app()->getAuthManager();
        $roles = array_keys($auth->getRoles());

        if (!in_array($role, $roles))
            return array();

        $user_ids = Yii::app()->db->createCommand()
            ->select('userid')
            ->from('authassignment a')
            ->where('itemname=:role', array(':role' => $role))
            ->queryAll();
        foreach ($user_ids as $key_user_id => $user_id)
            $user_ids[$key_user_id] = $user_id['userid'];
//die(var_dump($user_ids));
        return User::model()->findAllByPk($user_ids);
    }

    public static function getOnlineUsers($limit = 999)
    {
        $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
        try {
            $users = Yii::app()->db->createCommand()
                ->select('u.id, a.last_activity')
                ->from(Yii::app()->getModule('User')->tablePrefix . '_user u')
                ->join("$visitorTableName a", 'u.id=a.user_id')
                ->where('EXTRACT(EPOCH FROM (\'' . date('Y-m-d H:i:s') . '\'::timestamp - a.last_activity::timestamp)) < 300')
                ->limit($limit)
                ->queryAll();

            return $users;
        }
        catch(Exception $ex)
        {
            return [];
        }
    }

    public static function getIsOnlineUser($user_id)
    {
        $visitorTableName = Yii::app()->getModule('User')->tablePrefix . '_users_activity';
        $users = Yii::app()->db->createCommand()
            ->select('u.id, a.last_activity')
            ->from(Yii::app()->getModule('User')->tablePrefix.'_user u')
            ->join("$visitorTableName a", 'u.id=a.user_id')
            //->where('TIMESTAMPDIFF(MINUTE, last_activity, UTC_TIMESTAMP()) < 5')
            ->where('EXTRACT(EPOCH FROM (\'' . date('Y-m-d H:i:s') . '\'::timestamp - a.last_activity::timestamp)) < 300 AND a.user_id=' . $user_id)
            ->limit(1)
            ->queryAll();

        return !empty($users);
    }

    public static function GetDbSqlUsername($username)
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = $umodule == 'user' ? 'usr' : 'cli';
        //$transaction=Yii::app()->db->beginTransaction();
        try {
            $sql_username = $tablePrefix . '_' . $username . '_' . AP_DB_NAME;
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

    public static function GetCliDbSqlUsername()
    {
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

    public static function checkClientLogin()
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = $umodule == 'user' ? 'usr' : 'client';
        if ($tablePrefix !== 'client') {
            return true;
        } else
            return false;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return Yii::app()->getModule('User')->tablePrefix . '_user';
    }

    /*
     * @return last id < 9223372036854775807
     */

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('role', 'in', 'range'=>Yii::app()->getAuthManager()->getRoles()),
            array('username, password, passwordCompare', 'required', 'on' => 'insert'),
            array('username, idnp', 'unique'),
            array('idnp', 'length', 'min' => 13, 'max' => 13),
            array('create_user_id, update_user_id, idnp, status_id,sql_user', 'numerical', 'integerOnly' => true),
            array('create_user_id', 'default', 'value' => Yii::app()->user->id, 'on' => 'insert'),
            //array('update_user_id', 'default', 'value'=>Yii::app()->user->id, 'on'=>'update'),
            array('username, ad_username, role', 'length', 'max' => 45),
            array('password_hash', 'length', 'max' => 128),
            array('username', 'match', 'pattern' => '/^[a-zA-Z0-9_.\-]{4,45}/i', 'message' => 'Your username does not meet our complexity policy. The username must  contain  the letters, numbers, the underscore , points and the minimum length of username must be 4 chars .'),
            array('password', 'match', 'pattern' => '/^[a-zA-Z0-9_!@#$\-]{6,20}/i', 'message' => 'Your password does not meet our password complexity policy. The password can only contain letters, numbers, the underscore,the hyphen, and minimum length of password is 6 chars.'),
            array('passwordCompare', 'compare', 'compareAttribute' => 'password'),
            array('create_datetime', 'default', 'value' => date('Y-m-d H:i:s'), 'on' => 'insert'),
            array('certificate_path', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('username, ad_username, create_user_id, create_datetime, update_user_id, update_datetime, role, profile,status_id,sql_user', 'safe', 'on' => 'search'),
        );
    }

    /*
     * @return array list UserStatus
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
'r_userfffff_testdocument'=>array('CHasManyRelation','Testdocument','userfffff',),
            'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
            'profileAdditional' => array(self::HAS_ONE, 'ProfileAdditional', 'user_id'),
            'serviceAccesses' => array(self::HAS_MANY, 'ServiceAccess', 'user_id'),
        );
    }

    /*
     * @return status text
     */

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => Yii::t('UserModule.t', 'USERNAME'),
            'password' => Yii::t('UserModule.t', 'PASSWORD'),
            'passwordCompare' => Yii::t('UserModule.t', 'REPEAT_PASSWORD'),
            'ad_username' => Yii::t('UserModule.t', 'AD_USERNAME'),
            'role' => Yii::t('UserModule.t', 'ROLE'),
            'idnp' => Yii::t('UserModule.t', 'IDNP'),
            'status_id' => Yii::t('mess', 'STATUS'),
            'sql_user' => Yii::t('UserModule.t', 'SQL_USER'),
            'create_user_id' => Yii::t('mess', 'create_user_id'),
            'create_datetime' => Yii::t('mess', 'create_datetime'),
            'update_user_id' => Yii::t('mess', 'update_user_id'),
            'update_datetime' => Yii::t('mess', 'update_datetime'),
			'penalization' => Yii::t('mess','penalization'),


        );
    }


    /*
     *
     * @return true if user not blocked
     */

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

        $criteria = new CDbCriteria;
        $criteria->with = array('profile');

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('ad_username', $this->ad_username, true);
        $criteria->compare('idnp', $this->idnp, true);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('sql_user', $this->sql_user);
        if (Yii::app()->getUser()->isSa()) {
            $criteria->compare('t.create_user_id', $this->create_user_id, true);
        } else {
            $criteria->compare('t.create_user_id', Yii::app()->getUser()->getId());
        }
        //$criteria->compare('"profile"."firstname"',$this->profile->firstname,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
     * Get number all user register
     * @return int
     */

    /**
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->password_hash);
    }

    /*
     * Get all users blocked
     * @return int
     */

    public function getFull_name()
    {
        $_full_name = $this->profile->firstname . ' ' . $this->profile->lastname . ' ' . $this->profile->patronymic;
        if (trim($_full_name) == '')
            return $this->username;
        return $_full_name;
    }

    /*
     * Get all users with certificates
     * @return int
     */

    public function addRecoveryPass()
    {
        $penalization = $this->penalization == '' ? array() : json_decode($this->penalization, 1);
        $penalization['next_recovery_password'] = strtotime("+30 minutes");
        User::model()->updateByPk($this->id, array('penalization' => json_encode($penalization)));
    }

    /*
     * Check Holiday day
     * if not contain in array date now :return true 
     * if datenow contain in holiday array :return false
     * @return bool
     */

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

    public function getIsClient()
    {
        return AP_YII_UMODULE == 'Client';
    }

    protected function beforeSave()
    {


        if (parent::beforeSave()) {
            if ($this->isNewRecord && !empty($this->password)) {
                if (HelperCheckDB::CheckDbConnectionTypeMysql()) {
                    $newId = $this->getMaxId() + 1;
                    $this->setPrimaryKey($newId);
                    $this->status_id = 1;
                }

                $this->create_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->create_datetime = date("Y-m-d H:i:s");
                $this->password_hash = CPasswordHelper::hashPassword($this->password);
                return true;
            } else {
                $this->update_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
                $this->update_datetime = date("Y-m-d H:i:s");
                return true;
            }
        } else {
            return false;
        }

    }

    private function getMaxId()
    {
        $id = 9223372036854775807;
        $criteria = new CDbCriteria;
        $criteria->select = 'max(id) AS maxColumn';
        $criteria->condition = 'id <:id';
        $criteria->params = array(':id' => $id);
        $row = self::model()->find($criteria);
        $maxId = $row['maxColumn'];
        return $maxId;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterSave()
    {

        $profileAdditional = ProfileAdditional::model()->find('user_id=:user_id', array(':user_id' => $this->id));
        if ($profileAdditional === null) {
            $profileAdditional = new ProfileAdditional;
            $profileAdditional->id = $this->id;
            $profileAdditional->user_id = $this->id;
            $profileAdditional->save();
        }
        $profile = Profile::model()->find('user_id=:user_id', array(':user_id' => $this->id));
        if ($profile === null) {
            $profile_new = new Profile();
            $profile_new->id = $this->id;
            $profile_new->user_id = $this->id;
            $profile_new->email = $this->username . '@admin.com';
            $firstname = 'Not Set';
            $lastname = 'Not Set';
            $usr_explode = explode('.', $this->username);
            if (count($usr_explode) > 1) {
                $firstname = $usr_explode[0];
                $lastname = $usr_explode[1];
            }
            $profile_new->firstname = $firstname;
            $profile_new->lastname = $lastname;
            $profile_new->idnp = !is_null($this->idnp) ? $this->idnp : mt_rand(1000000000000, 9999999999999);
            if ($profile_new->validate()) {
                $profile_new->save();
            } else {
                $errors = $profile_new->getErrors();
                die(var_dump($errors)); //or print_r($errors)
            }
        }
        $settings = UserSettings::model()->find('user_id=:user_id', array(':user_id' => $this->id));
        if ($settings === null) {
            $settings = new UserSettings();
            $settings->id = $this->id;
            $settings->user_id = $this->id;
            $settings->time_limit = 0;
            $settings->restricted_id = 0;
            $settings->save();
        }

        if ($this->isNewRecord)
            //Se creaza utilizatorul in owncloud daca inregistrarea e noua
            HelperOwncloud::CreateUser($this);
        else
            //Se editeaza utilizatorul existent daca inregistrarea exista
            HelperOwncloud::EditUser($this->id);


        return true;
    }

    protected function afterDelete()
    {
        $profile = Profile::model()->find('user_id=:user_id', array(':user_id' => $this->id));
        if ($profile) {
            $profile->delete();
        }
        $profileAdditional = ProfileAdditional::model()->find('user_id=:user_id', array(':user_id' => $this->id));
        if ($profileAdditional) {
            $profileAdditional->delete();
        }

        HelperOwncloud::DeleteUser($this->username);

    }
}
