<?php

class ClientProfileController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via SUBSIDIARY request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $curr_user = Client::model()->findByPk(Yii::app()->user->id);
        $curr_prof = $curr_user->profile;
        if ($id != $curr_prof->id && !Yii::app()->user->isSa())
            $id = $curr_prof->id;

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'additionalProfileModel' => $this->loadAdditionalProfileModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Profile the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Profile::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadAdditionalProfileModel($id)
    {
        $additionalProfileModel = ProfileAdditional::model()->findByPk($id);
        if ($additionalProfileModel === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $additionalProfileModel;
    }

    /**
     * Edites a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionEdit(/*$id*/)
    {
        $id = Yii::app()->user->id;
        if (is_null($id))
            throw new CHttpException(403, 'Id-ul dvs nu a fost gasit in sistem');

        $model = $this->loadModel($id);
        $additionalProfileModel = $this->loadAdditionalProfileModel($id);

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');
            if ($model->avatar) {
                $save_path = UserFilesManagerProvider::getAvatarsFolder();
                $save_file = 'avatar_' . md5($id) . '.' . $model->avatar->extensionName;
                $model->avatar->saveAs(($save_path . '/' . $save_file));
            }
            //die(var_dump($model->avatar));
            //CVarDumper::dump($model,100, true); die();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        if (isset($_POST['ProfileAdditional'])) {
            $additionalProfileModel->attributes = $_POST['ProfileAdditional'];

            //die(var_dump($additionalProfile->attributes));
            if ($additionalProfileModel->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('edit', array(
            'model' => $model,
            'additionalProfileModel' => $additionalProfileModel,
            'fieldsConfig' => $fieldsConfig
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Profile');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Profile('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Profile']))
            $model->attributes = $_GET['Profile'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionFields()
    {
        $model = new FieldForm();

        if (isset($_POST['FieldForm'])) {
            $model->attributes = $_POST['FieldForm'];
            if ($model->validate()) {
                if ($model->addField()) {
                    Yii::app()->user->setFlash('success', 'Field was added successfully.');
                    $this->redirect('fields');
                }
            }
        }
        $columns = ProfileAdditional::model()->attributeLabels();
        unset($columns['id']);
        unset($columns['user_id']);
        $this->render('fields', array(
            'columns' => $columns,
            'model' => $model,
        ));
    }

    public function actionGetColumns()
    {
        $columns = Yii::app()->db->getSchema()->getTable($_POST['FieldForm']['refTable'])->columnNames;
        unset($columns[0]);
        foreach ($columns as $key => $value) {
            echo CHtml::tag('option',
                array('value' => $value),
                $value, true);
        }
        Yii::app()->end();
    }

    public function actionDeleteField()
    {
        $model = new FieldForm();

        if (isset($_POST['FieldForm'])) {
            $model->attributes = $_POST['FieldForm'];
            if ($model->validate()) {
                if ($model->deleteField()) {
                    Yii::app()->user->setFlash('deleteSuccess', 'Field was deleted successfully.');
                    $this->redirect('fields');
                }
            }
        }
        $columns = ProfileAdditional::model()->attributeLabels();
        unset($columns['id']);
        $this->render('fields', array(
            'columns' => $columns,
            'model' => $model,
        ));
    }

    public function getAttributes()
    {

    }

    /**
     * Performs the AJAX validation.
     * @param Profile $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
