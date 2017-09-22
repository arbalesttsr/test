<?php

class PasswordController extends Controller
{
    public $layout = 'main';

    public function actionChange()
    {
        $model = new PasswordForm;

        if (isset($_POST['PasswordForm'])) {
            $model->attributes = $_POST['PasswordForm'];

            if ($model->authenticate()) {
                if ($model->validate() && $model->changePassword()) {
                    Yii::app()->user->setFlash('success', 'Password was changed successfully.');
                }
            }
        }
        $this->render('change', array('model' => $model));
    }

}