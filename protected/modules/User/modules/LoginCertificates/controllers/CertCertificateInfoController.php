<?php

class CertCertificateInfoController extends Controller
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
        if (isset($_GET['name']))
            $name = $_GET['name'];
        else
            $name = '';
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'name' => $name,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CertCertificateInfo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = CertCertificateInfo::model()->findByPk($id);
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
        $model = new CertCertificateInfo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CertCertificateInfo'])) {
            $model->attributes = $_POST['CertCertificateInfo'];
            //if($model->createCertificate())
            if ($model->generateCertificateCRT()) {
                $user = User::model()->findByPk($model->user_id);
                $path_crt = CertSettings::getDefaultConfigCertigicatesPath() . $user->username . '.crt';
                if (file_exists($path_crt))
                    $model->cert_crt = file_get_contents($path_crt);

                $model->cert_key = $model->generateCertificateKEY();

                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id, 'name' => $user->username));
            }

        }

        $this->render('create_cert', array(
            'model' => $model,
        ));
    }

    public function actionDownloadKey()
    {
        $model = new CertCertificateInfo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mod = $this->loadModel($id);


            $model->downloadPrivateKey(User::model()->findByPk($mod->user_id)->username);

        }
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

        if (isset($_POST['CertCertificateInfo'])) {
            $model->attributes = $_POST['CertCertificateInfo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $user = User::model()->findByPk($model->user_id);

        $path = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
        $certificate_crt = $path . CertSettings::getDefaultConfigCertigicatesPath() . $user->username . '.crt';
        $private_key = $path . CertSettings::getDefaultConfigKeysPath() . $user->username . '.key';
        if (file_exists($certificate_crt))
            unlink($certificate_crt);

        if (file_exists($private_key))
            unlink($private_key);


        $user->certificate_path = NULL;
        $user->update(array('certificate_path'));
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
        $dataProvider = new CActiveDataProvider('CertCertificateInfo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new CertCertificateInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CertCertificateInfo']))
            $model->attributes = $_GET['CertCertificateInfo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CertCertificateInfo $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cert-certificate-info-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
