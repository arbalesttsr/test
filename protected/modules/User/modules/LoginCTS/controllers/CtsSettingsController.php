<?php

class CtsSettingsController extends Controller
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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CtsSettings the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = CtsSettings::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {

        $model = new CtsSettings;

        if (isset($_POST['CtsSettings'])) {
            $model->attributes = $_POST['CtsSettings'];
            $model->key = is_null(CUploadedFile::getInstance($model, 'key')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'key');
            $model->certificate = is_null(CUploadedFile::getInstance($model, 'certificate')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'certificate');
            $model->validate_response_key = is_null(CUploadedFile::getInstance($model, 'validate_response_key')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'validate_response_key');

            //die(var_dump($model->v_responsekey_path,$model->certificate_path,$model->key_path));
            if ($model->save()) {
                $path = $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'cts' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR;

                $key = $path . 'keys' . DIRECTORY_SEPARATOR . $model->key;
                if (file_exists($key)) {
                    $new_name_key = time() . '_' . $model->key;
                    $key = $path . 'keys' . DIRECTORY_SEPARATOR . $new_name_key;
                    $model->key->saveAs($key);
                    $cts = $this->loadModel($model->id);
                    $cts->key = $new_name_key;
                    $cts->update();
                } else
                    $model->key->saveAs($key);

                $certificate = $path . 'certs' . DIRECTORY_SEPARATOR . $model->certificate;
                if (file_exists($certificate)) {
                    $new_name_cert = time() . '_' . $model->certificate;
                    $certificate = $path . 'certs' . DIRECTORY_SEPARATOR . $new_name_cert;
                    $model->certificate->saveAs($certificate);
                    $cts = $this->loadModel($model->id);
                    $cts->certificate = $new_name_cert;
                    $cts->update();
                } else
                    $model->certificate->saveAs($certificate);

                $validate_response_key = $path . 'responsekeys' . DIRECTORY_SEPARATOR . $model->validate_response_key;
                if (file_exists($validate_response_key)) {
                    $new_name_response_key = time() . '_' . $model->validate_response_key;
                    $validate_response_key = $path . 'responsekeys' . DIRECTORY_SEPARATOR . $new_name_response_key;
                    $model->validate_response_key->saveAs($validate_response_key);
                    $cts = $this->loadModel($model->id);
                    $cts->validate_response_key = $new_name_response_key;
                    $cts->update();
                } else
                    $model->validate_response_key->saveAs($validate_response_key);

//                    $model->key->saveAs($key);
//                    $model->certificate->saveAs($certificate);
//                    $model->validate_response_key->saveAs($validate_response_key);


                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('create', array('model' => $model));

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CtsSettings'])) {
            $model->attributes = $_POST['CtsSettings'];
            $model->key = is_null(CUploadedFile::getInstance($model, 'key')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'key');
            $model->certificate = is_null(CUploadedFile::getInstance($model, 'certificate')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'certificate');
            $model->validate_response_key = is_null(CUploadedFile::getInstance($model, 'validate_response_key')) ? 'Not Set File' : CUploadedFile::getInstance($model, 'validate_response_key');

            //die(var_dump($model->v_responsekey_path,$model->certificate_path,$model->key_path));
            if ($model->save()) {
                $path = $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'cts' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR;

                $key = $path . 'keys' . DIRECTORY_SEPARATOR . $model->key;
                if (file_exists($key)) {
                    $new_name_key = time() . '_' . $model->key;
                    $key = $path . 'keys' . DIRECTORY_SEPARATOR . $new_name_key;
                    $model->key->saveAs($key);
                    $cts = $this->loadModel($model->id);
                    $cts->key = $new_name_key;
                    $cts->update();
                } else
                    $model->key->saveAs($key);

                $certificate = $path . 'certs' . DIRECTORY_SEPARATOR . $model->certificate;
                if (file_exists($certificate)) {
                    $new_name_cert = time() . '_' . $model->certificate;
                    $certificate = $path . 'certs' . DIRECTORY_SEPARATOR . $new_name_cert;
                    $model->certificate->saveAs($certificate);
                    $cts = $this->loadModel($model->id);
                    $cts->certificate = $new_name_cert;
                    $cts->update();
                } else
                    $model->certificate->saveAs($certificate);

                $validate_response_key = $path . 'responsekeys' . DIRECTORY_SEPARATOR . $model->validate_response_key;
                if (file_exists($validate_response_key)) {
                    $new_name_response_key = time() . '_' . $model->validate_response_key;
                    $validate_response_key = $path . 'responsekeys' . DIRECTORY_SEPARATOR . $new_name_response_key;
                    $model->validate_response_key->saveAs($validate_response_key);
                    $cts = $this->loadModel($model->id);
                    $cts->validate_response_key = $new_name_response_key;
                    $cts->update();
                } else
                    $model->validate_response_key->saveAs($validate_response_key);

                // redirect to success page
                $this->redirect(array('view', 'id' => $model->id));
            }

//			$model->attributes=$_POST['CtsSettings'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {

        $model = $this->loadModel($id);
        $path = $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'cts' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR;
        $key = $path . 'keys' . DIRECTORY_SEPARATOR . $model->key;
        $certificate = $path . 'certs' . DIRECTORY_SEPARATOR . $model->certificate;
        $validate_response_key = $path . 'responsekeys' . DIRECTORY_SEPARATOR . $model->validate_response_key;
        if (file_exists($key))
            unlink($key);

        if (file_exists($certificate))
            unlink($certificate);

        if (file_exists($validate_response_key))
            unlink($validate_response_key);

        if ($model->is_default == 1) {
            $cts = CtsSettings::model()->findAll();
            if ($cts) {
                foreach ($cts as $value) {

                    CtsSettings::model()->updateByPk($value->id, array('is_default' => 1));
                    break;
                }
            }
        }

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
        $dataProvider = new CActiveDataProvider('CtsSettings');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new CtsSettings('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CtsSettings']))
            $model->attributes = $_GET['CtsSettings'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionViewCertificates($id)
    {
        $model = $this->loadModel($id);
        $path = $realpath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'cts' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR;
        $key = file_exists($path . 'keys' . DIRECTORY_SEPARATOR . $model->key) ? file_get_contents($path . 'keys' . DIRECTORY_SEPARATOR . $model->key) : 'File not found !!!';
        $certificate = file_exists($path . 'certs' . DIRECTORY_SEPARATOR . $model->certificate) ? file_get_contents($path . 'certs' . DIRECTORY_SEPARATOR . $model->certificate) : 'File not found !!!';
        $validate_response_key = file_exists($path . 'responsekeys' . DIRECTORY_SEPARATOR . $model->validate_response_key) ? file_get_contents($path . 'responsekeys' . DIRECTORY_SEPARATOR . $model->validate_response_key) : 'File not found !!!';
        $this->render('view_cert', array(
            'model' => $model,
            'key' => $key,
            'certificate' => $certificate,
            'validate_response_key' => $validate_response_key,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CtsSettings $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cts-settings-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
