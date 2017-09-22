<?php

/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 2/12/15
 * Time: 11:15 AM
 */
class ImportUsersAD extends CFormModel
{
    public $userAd;
    public $passwordAd;
    public $ldap_setting;
    public $role;

    public static function CheckInUserAdUsername($username)
    {
        $model = User::model()->findByAttributes(array('ad_username' => $username));
        if ($model) {
            return $username;
        } else {
            return 'Not Set';
        }
    }

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('userAd,passwordAd,ldap_setting,role', 'required'),
            array('userAd,passwordAd', 'length', 'max' => 100),
            //array('column', 'in', 'range'=> CActiveRecord::model(Yii::app()->getModule('pii')->userClass)->attributeNames()),
            // password needs to be authenticated
            //array('password', 'authenticate'),
            // array('newPassword', 'match', 'pattern'=>'/^[a-z0-9_-]{4,20}$/i',
            //    'message'=>'The {attribute} ca only contain letters, numbers, the underscore, and the hyphen.'),
            // array('comparePassword', 'compare', 'compareAttribute'=>'newPassword'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'userAd' => Yii::t('mess', 'USER_AD'),
            'passwordAd' => Yii::t('mess', 'PASSWORD_AD'),
            'ldap_setting' => Yii::t('mess', 'Ldap Setting'),
            'role' => Yii::t('UserModule.t', 'ROLE'),
        );
    }
}