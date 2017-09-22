<?php

/**
 * CWebUser represents the persistent state for a Web application user.
 *
 * WebUser extends the CWebUser class which is used as an application component whose ID is 'user'.
 * Therefore, at any place one can access the user state via
 * <code>Yii::app()->user</code>.
 */
class WebUser extends CWebUser
{
    public function checkAccess($operation, $params = array(), $allowCaching = true)
    {
        //return true;
        if ($this->isSa()) {
            return true;
        }

        if (!isset(Yii::app()->modules['User']['modules']['Rbam'])) {
            return true;
        } else {
            /*if (Yii::app()->getRequest()->getIsAjaxRequest()) {
             return true;
         }*/
            try{
                return parent::checkAccess($operation, $params, $allowCaching);
            }
            catch(Exception $ex){}
        }
    }

    /**
     * Specify if the user is System Administrator user
     * @return bool
     */
    public function isSa()
    {
        return $this->getState('sa') === User::SA;
    }

    public function isHisUser($userId)
    {
        return User::model()->findByPk($userId)->create_user_id === $this->getId() or $userId === $this->getId();
    }

    public function getProfile()
    {
        return Profile::model()->findByPk($this->getId());
    }

    public function getProfileAdditional()
    {
        return ProfileAdditional::model()->findByPk($this->getId());
    }

    public function getUsername()
    {
        if (isset(User::model()->findByPk($this->getId())->username))
            return User::model()->findByPk($this->getId())->username;
        else
            return '';
    }

    public function getPassword()
    {
        return User::model()->findByPk($this->getId())->password_hash;
    }

    public function getIdnp()
    {
        return User::model()->findByPk($this->getId())->idnp;
    }
}
