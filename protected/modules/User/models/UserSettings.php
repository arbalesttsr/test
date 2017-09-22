<?php

/**
 * This is the model class for table "adm_user_settings".
 *
 * The followings are the available columns in table 'adm_user_settings':
 * @property string $id
 * @property string $user_id
 * @property string $time_limit
 * @property integer $restricted_id
 * @property string $restricted_days
 * @property string $restricted_date
 * @property string $restricted_interval
 * @property string $date_start
 * @property string $start_time
 * @property string $end_time
 * @property string $holiday_enable
 */
class UserSettings extends CActiveRecord
{


    //restricted
    const RESTRICT_NO_RESTRICTED = 0;
    const RESTRICT_IN_TIME = 1;
    // const RESTRICT_IN_DAYS = 2;
    const RESTRICT_BY_DATE = 3;
    const RESTRICT_BY_INTERVAL = 4;

    public static function CheckUserEnableHolidays($username, $loginMethod)
    {
        if ($loginMethod == 1)
            $user = User::model()->findByAttributes(array('username' => $username));
        if ($loginMethod == 2)
            $user = User::model()->findByAttributes(array('ad_username' => $username));
        if ($loginMethod == 3)
            $user = User::model()->findByAttributes(array('username' => $username));

        if ($user) {
            $model = self::model()->findByAttributes(array('user_id' => $user->id));
            if ($model) {
                //   die(var_dump($this->checkHolidayDateWork()));
                if (UserSettings::checkHolidayDateWork() && $model->holiday_enable == 0)
                    return true;
                else {
                    return false;
                }
            }

        } else {
            return FALSE;

        }
    }

    public static function checkHolidayDateWork()
    {
        $now_date = date("Y-d-m");
        $holidays = Holidays::GetListaDatesHolidays();
        //$holidays = ClasificatorUserProvider::getHolidaysDates();

        if (!in_array($now_date, $holidays)) {
            return true;
        } else
            return false;

    }

    public static function checkWorkTime($login, $loginMethod)
    {
        $date_start = null;

        if ($loginMethod == 1)
            $user = User::model()->findByAttributes(array('username' => $login));
        if ($loginMethod == 2)
            $user = User::model()->findByAttributes(array('ad_username' => $login));
        if ($loginMethod == 3)
            $user = User::model()->findByAttributes(array('username' => $login));

        if ($user) {
            $model = self::model()->findByAttributes(array('user_id' => $user->id));
            if ($model) {
                //die(var_dump($model));
                //verificare time_limit
                if (!is_null($model->date_start) && $model->date_start !== '0000-00-00 00:00:00' && $model->time_limit !== 0) {
                    $minutes_to_add = $model->time_limit;
                    $time = new DateTime($model->date_start);
                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $result = $time->format('Y-m-d H:i:s');
                    $date1 = new DateTime($result);
                    $date2 = new DateTime(date('Y-m-d H:i:s'));
                    if ($date1 > $date2)
                        return true;
                    else
                        return false;

                }

                //verificare restricted date
                $restrict_date = $model->restricted_date;
                if (!is_null($restrict_date) && date('Y-m-d') == $restrict_date)
                    return false;


                if (!is_null($model->start_time) && !is_null($model->end_time)) {
                    $datetime_now = date('Y-m-d H:i:s');
                    $datetime_start = date('Y-m-d') . ' ' . $model->start_time;
                    $datetime_end = date('Y-m-d') . ' ' . $model->end_time;

                    if ($datetime_now >= $datetime_start && $datetime_now <= $datetime_end)
                        return true;
                    else
                        return false;
                } else
                    return true;

            } else
                return true;
        }

    }

    public static function getUserWorkTime($user_id)
    {
        $model = self::model()->findByAttributes(array('user_id' => $user_id));

        if (!is_null($model)) {

            return $model->start_time . ' - ' . $model->end_time;
        } else
            return '';
    }

    public static function getUserRestrictedDate($user_id)
    {
        $model = self::model()->findByAttributes(array('user_id' => $user_id));

        if (!is_null($model)) {
            if (!is_null($model->restricted_date))
                return $model->restricted_date;
            else
                return 'Not Set';
        } else
            return '';
    }

    public static function getUserRestrictedTime($user_id)
    {
        $model = self::model()->findByAttributes(array('user_id' => $user_id));

        if (!is_null($model)) {
            if (!is_null($model->date_start) && $model->time_limit !== 0)
                return '<b style="color:red;">' . $model->time_limit . '</b> minutes';
            else
                return 'Not Set';
        } else
            return '';
    }

    public static function getUserRestrictedTimeLeft($user_id)
    {
        $model = self::model()->findByAttributes(array('user_id' => $user_id));

        if (!is_null($model)) {
            if (!is_null($model->date_start) && $model->time_limit !== 0) {
                $minutes_to_add = $model->time_limit;
                $time = new DateTime($model->date_start);
                $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $result = $time->format('Y-m-d H:i:s');


                $d1 = new DateTime($result);
                if ($result > date('Y-m-d H:i:s')) {
                    $data_now = (string)date('Y-m-d H:i:s');
                    $data_from_bd = (string)$result;
                    $ramsa = self::timeDiff($data_from_bd, $data_now);
                    $minutes = round($ramsa / 60);
                    return '<b style="color:red;">' . $minutes . '</b> minutes';
                    //die(var_dump($ramsa));

                } else {
                    return '0';
                }
            } // return '<b style="color:red;">'.$model->time_limit .'</b> minutes';
            else
                return 'Not Set';
        } else
            return '';
    }


    /*
     * @return array list RestrictedStatus
     */

    private static function timeDiff($firstTime, $lastTime)
    {

        // convert to unix timestamps
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);

        // perform subtraction to get the difference (in seconds) between times
        //$timeDiff=$lastTime-$firstTime;
        $timeDiff = $firstTime - $lastTime;

        // return the difference
        return $timeDiff;
    }

    /*
     * @return restricted text
     */

    public static function getUserRestrictedLeftMinute($user_name)
    {
        if (!is_null(User::model()->findByAttributes(array('username' => $user_name)))) {
            $model = self::model()->findByAttributes(array('user_id' => User::model()->findByAttributes(array('username' => $user_name))->id));

            if (!is_null($model)) {
                if (!is_null($model->date_start) && $model->time_limit !== 0) {
                    $minutes_to_add = $model->time_limit;
                    $time = new DateTime($model->date_start);
                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $result = $time->format('Y-m-d H:i:s');
                    //$d1 = new DateTime($result);
                    if ($result > date('Y-m-d H:i:s')) {
                        $data_now = (string)date('Y-m-d H:i:s');
                        $data_from_bd = (string)$result;
                        $ramas = self::timeDiff($data_from_bd, $data_now);
                        $minutes = round($ramas / 60);
                        return (int)$minutes;

                    } else {
                        return 0;
                    }
                } else
                    return 0;
            } else
                return 0;
        } else
            return 0;
    }


    /*
     * @return is restricted
     */

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return Yii::app()->getModule('User')->tablePrefix . '_user_settings';
    }


    /*
     * @return restricted date
     */

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, restricted_id', 'required'),
            array('restricted_id,holiday_enable,create_user_id', 'numerical', 'integerOnly' => true),
            array('user_id, time_limit', 'length', 'max' => 20),
            //array('time_limit', 'numerical', 'integerOnly'=>true, 'min'=>5),
            //array('time_limit', 'length', 'min'=>0, 'max'=>1440),
            array('restricted_days', 'length', 'max' => 50),
            array('restricted_date, restricted_interval', 'length', 'max' => 255),
            array('create_datetime', 'default', 'value' => date('Y-m-d H:i:s'), 'on' => 'insert'),
            array('date_start,start_time,end_time,holiday_enable,create_user_id, create_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, time_limit, restricted_id, restricted_days, restricted_date, restricted_interval, date_start,start_time,end_time,holiday_enable,create_user_id, create_datetime, update_user_id, update_datetime', 'safe', 'on' => 'search'),
        );
    }

    /*
     *
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'user_create' => array(self::BELONGS_TO, 'User', 'create_user_id'),
        );
    }


    /*
     * if datenow contains in arrays holidays return false
     * if datenow  not contains in arrays holidays return true
     * @return bool
     */

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => Yii::t('UserModule.t','USER'),
            'time_limit' => Yii::t('mess','time_limit'),
            'restricted_id' => Yii::t('mess','restricted_id'),
            'restricted_days' => Yii::t('mess','restricted_days'),
            'restricted_date' => Yii::t('mess','restricted_date'),
            'restricted_interval' => Yii::t('mess','restricted_interval'),
            'date_start' => Yii::t('mess','date_start'),
            'start_time' => Yii::t('mess','start_time'),
            'end_time' => Yii::t('mess','end_time'),
            'holiday_enable' => Yii::t('mess','holiday_enable'),
            'create_user_id'  => Yii::t('mess', 'create_user_id'),
            'create_datetime' => Yii::t('mess', 'create_datetime'),
            'update_user_id'  => Yii::t('mess', 'update_user_id'),
            'update_datetime' => Yii::t('mess', 'update_datetime'),
        );
    }

    /*
     * checkWorkTime user
     * @return restricted date
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('time_limit', $this->time_limit, true);
        $criteria->compare('restricted_id', $this->restricted_id);
        $criteria->compare('restricted_days', $this->restricted_days, true);
        $criteria->compare('restricted_date', $this->restricted_date, true);
        $criteria->compare('restricted_interval', $this->restricted_interval, true);
        $criteria->compare('date_start', $this->date_start, true);
        $criteria->compare('start_time', $this->start_time, true);
        $criteria->compare('end_time', $this->end_time, true);
        $criteria->compare('holiday_enable', $this->holiday_enable, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /*
     * Get User Work Time ex: "08:00:00 - 20:00:00"
     * @return string
     */

    public function getRestrictedText()
    {
        $userRestricted = $this->getRestrictedStatus();
        return isset($userRestricted[$this->restricted_id]) ?
            $userRestricted[$this->restricted_id] : "unknown restricted ({$this->restricted_id})";
    }

    /*
     * Get User Resticted Date ex: "2014-10-01"
     * @return string
     */

    public function getRestrictedStatus()
    {
        return array(
            self::RESTRICT_NO_RESTRICTED => "Nu este restictionat",
            self::RESTRICT_IN_TIME => "Restrictionat in timp",
            // self::RESTRICT_IN_DAYS =>"Restrictionat in zile",
            self::RESTRICT_BY_DATE => "Restrictionat la o data",
            self::RESTRICT_BY_INTERVAL => "Restrictionat pe interval",
        );
    }

    /*
     * Get User Restricted Time ex: "90 minutes"
     * @return string
     */

    public function getRestrictedDate($user_id)
    {
        if ($this->isRestricted($user_id) === self::RESTRICT_BY_DATE) {
            return UserSettings::model()->findByAttributes(array('user_id' => $user_id))->restricted_date;
        } else
            return NULL;
    }

    /*
     * Get User Restricted Time Left ex: "90 minutes"
     * @return string
     */

    public static function isRestricted($id)
    {
        $restric = UserSettings::model()->findByAttributes(array('user_id' => $id));

        if (is_null($restric))
            throw new CHttpException(404, 'The model is null.');
        else
            return $restric->restricted_id;
    }

    /*
 * Get User Restricted Time Left ex: "90 minutes"
 * @return string
 */

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserSettings the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /*
     * //Usage :
    echo timeDiff("2002-04-16 10:00:00","2002-03-16 18:56:32");
     */

    protected function beforeSave()
    {

        //die(var_dump($this));
        if ($this->isNewRecord) {
            if (!empty($this->time_limit) && empty($this->date_start))
                $this->date_start = date("Y-m-d H:i:s");
            $this->create_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
            $this->create_datetime = date("Y-m-d H:i:s");
            return true;
        } else {
            $this->date_start = ($this->date_start !== '') ? $this->date_start : NULL;
            $this->time_limit = ($this->time_limit !== 0 && !is_null($this->date_start)) ? $this->time_limit : 0;

            $this->restricted_date = ($this->restricted_date !== '') ? $this->restricted_date : NULL;

            $this->restricted_interval = ($this->restricted_interval !== '') ? $this->restricted_interval : NULL;
            $this->start_time = ($this->start_time !== '') ? $this->start_time : NULL;
            $this->end_time = ($this->end_time !== '') ? $this->end_time : NULL;

            if (!is_null($this->date_start))
                $this->restricted_id = self::RESTRICT_IN_TIME;

            if (!is_null($this->restricted_date))
                $this->restricted_id = self::RESTRICT_BY_DATE;

            if (!is_null($this->restricted_interval))
                $this->restricted_id = self::RESTRICT_BY_INTERVAL;


            $this->update_user_id = is_null(Yii::app()->user->id) ? 0 : Yii::app()->getUser()->getId();
            $this->update_datetime = date("Y-m-d H:i:s");
            return true;
        }
        return parent::beforeSave();
    }
}
