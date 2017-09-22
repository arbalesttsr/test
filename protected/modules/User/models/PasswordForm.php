<?php

/**
 * ChangePasswordForm class.
 * ChangePasswordForm is the data structure for keeping
 * user register form data. It is used by the 'change' action of 'PasswordController'.
 */
class PasswordForm extends CFormModel
{
    public $currentPassword;
    public $newPassword;
    public $comparePassword;

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
            array('currentPassword, newPassword, comparePassword', 'required'),
            //array('column', 'in', 'range'=> CActiveRecord::model(Yii::app()->getModule('pii')->userClass)->attributeNames()),
            // password needs to be authenticated
            //array('password', 'authenticate'),
            array('newPassword', 'match', 'pattern' => '/^[a-z0-9_-]{4,20}$/i',
                'message' => 'The {attribute} ca only contain letters, numbers, the underscore, and the hyphen.'),
            array('comparePassword', 'compare', 'compareAttribute' => 'newPassword'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'currentPassword' => Yii::t('UserModule.t', 'CURRENT_PASSWORD'),
            'newPassword' => Yii::t('UserModule.t', 'NEW_PASSWORD'),
            'comparePassword' => Yii::t('UserModule.t', 'REPEAT_PASSWORD'),
        );
    }


    public function authenticate()
    {
        if (isset($this->currentPassword)) {
            $this->_identity = new UserIdentity(Yii::app()->user->name, $this->currentPassword);

            $user = User::model()->findByPk(Yii::app()->user->id);
            if($user->validatePassword($this->currentPassword))
                return true;
            else {
                $this->addError('currentPassword','Incorrect password.');
                return false;
            }
        }
    }

    public function changePassword()
    {
        $id = Yii::app()->user->id;
        $model = User::model()->findByPk($id);
        $model->password_hash = CPasswordHelper::hashPassword($this->newPassword);
        return $model->update();
    }
}