<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property string $gender
 * @property date $birthday
 * @property string $about
 * @property string $update_datetime
 * @property integer $subsidiary_id
 * @property integer $department_id
 * @property string $phone
 * @property string $mobile
 * @property string $idnp
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Subsidiary $subsidiary
 * @property Department $department
 * @property Locality $locality
 */
class Profile extends CActiveRecord
{
    // Constants for gender
    const NOT_KNOWN = 0;
    const MALE = 1;
    const FEMALE = 2;

    public $avatar;

    public static function getProfileAvatar($user_id, $dim = '24*24')
    {
        return UserFilesManagerProvider::getProfileImage($user_id, $dim);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        $umodule = strtolower(AP_YII_UMODULE);
        $tablePrefix = $umodule == 'user' ? 'adm' : 'cli';
        return $tablePrefix . '_profile';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, email, firstname, lastname, idnp', 'required'),
            array('user_id, subsidiary_id, department_id', 'numerical', 'integerOnly' => true),
            array('firstname, lastname, patronymic, phone, mobile', 'length', 'max' => 45),
            array('about', 'length', 'max' => 255),
            array('email', 'length', 'max' => 100),
            array('idnp', 'length', 'min' => 8, 'max' => 13),
            //array('email', 'email'),
            //array('email, user_id,idnp', 'unique'),
            array('gender', 'default', 'value' => self::NOT_KNOWN),
            array('birthday', 'date', 'format' => 'yyyy-mm-dd'),
            array('avatar', 'file', 'types' => 'jpg, jpeg, gif, png', 'allowEmpty' => true,/*, 'maxSize'=>1024 * 200, 'tooLarge' => 'Fisierul nu trebuie sa depaseasca 200KB'*/),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('email, firstname, lastname, patronymic,idnp,avatar', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => Yii::t('UserModule.t', 'USER'),
            'email' => Yii::t('UserModule.t', 'EMAIL'),
            'firstname' => Yii::t('UserModule.t', 'FIRSTNAME'),
            'lastname' => Yii::t('UserModule.t', 'LASTNAME'),
            'patronymic' => Yii::t('UserModule.t', 'PATRONYMIC'),
            'gender' => Yii::t('UserModule.t', 'GENDER'),
            'birthday' => Yii::t('UserModule.t', 'BIRTHDAY'),
            'about' => Yii::t('UserModule.t', 'ABOUT'),
            'update_datetime' => Yii::t('base', 'UPDATED_AT'),
            'subsidiary_id' => Yii::t('UserModule.t', 'SUBSIDIARY'),
            'department_id' => Yii::t('UserModule.t', 'DEPARTMENT'),
            'phone' => Yii::t('UserModule.t', 'PHONE'),
            'mobile' => Yii::t('UserModule.t', 'MOBILE'),
            'idnp' => Yii::t('UserModule.t', 'IDNP'),
            'avatar' => Yii::t('UserModule.t', 'AVATAR'),
        );
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('email', $this->email);
        $criteria->compare('firstname', $this->firstname);
        $criteria->compare('lastname', $this->lastname);
        $criteria->compare('patronymic', $this->patronymic);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('birthday', $this->birthday);
        $criteria->compare('about', $this->about);
        $criteria->compare('phone', $this->phone);
        $criteria->compare('mobile', $this->mobile);
        $criteria->compare('idnp', $this->idnp);
        $criteria->compare('update_datetime', $this->update_datetime);


        $relations = Profile::model()->relations();

        if (isset($relations['user'])) {
            $criteria->with = 'user';
            $criteria->compare('create_user_id', Yii::app()->getUser()->getId());
            $criteria->compare('user.username', $this->user_id, true);
        } else $criteria->compare('user_id', $this->user_id);

        if (isset($relations['subsidiary'])) {
            $criteria->with = 'subsidiary';
            $criteria->compare('subsidiary.name', $this->subsidiary_id, true);
        } else $criteria->compare('subsidiary_id', $this->subsidiary_id);

        if (isset($relations['department'])) {
            $criteria->with = 'department';
            $criteria->compare('department.name', $this->department_id, true);
        } else $criteria->compare('department_id', $this->department_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'subsidiary' => array(self::BELONGS_TO, 'Subsidiary', 'subsidiary_id'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Profile the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getGender($gender)
    {
        if ($gender !== null) {
            $genders = $this->getGenders();
            return $genders[$gender];
        } else {
            throw new CException("Given param is null.", 1);
        }
    }

    public function getGenders()
    {
        return array(
            self::NOT_KNOWN => Yii::t('UserModule.t', 'UNKNOWN'),
            self::MALE => Yii::t('UserModule.t', 'MALE'),
            self::FEMALE => Yii::t('UserModule.t', 'FEMALE'),
        );
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                return true;
            } else {
                $attributes = $this->getAttributes();
                foreach ($attributes as $name => $value) {
                    if ($value === '') {
                        $this->setAttribute($name, null);
                    }
                }
                //CVarDumper::dump($this->getAttributes(),100, true); die();
                $this->update_datetime = date('Y-m-d H:i:s');

                return true;
            }
        } else {
            return false;
        }
    }

    protected function afterSave()
    {
        //Se editeaza utilizatorul existent daca inregistrarea exista
        HelperOwncloud::EditUser($this->user_id);
        return parent::afterSave();
    }
}
