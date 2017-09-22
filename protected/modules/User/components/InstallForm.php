<?php

/**
 * InstallForm class.
 * InstallForm is the data structure for keeping
 * user login form data. It is used by the 'installation' action of 'DefaultController'.
 */
class InstallForm extends CFormModel
{

    public $install;

    public function rules()
    {
        return array(
            // install are required
            array('install', 'required', 'requiredValue' => 1,
                'message' => 'You must check the box.'),
            // rememberMe needs to be a boolean
            array('install', 'boolean'),

        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'install' => Yii::t('UserModule.t', 'INSTALLATION_AGREE'),
        );
    }


}
