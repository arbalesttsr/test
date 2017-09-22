<?php

Yii::import('application.modules.install.forms.*');

class DefaultController extends CController
{

    public $layout = 'install';

    public $writeAble = array(
        'protected/config/main.php',
        'protected/runtime',
        'assets',
        //'assets/productThumbs',
        //'uploads',
        //'uploads/product',
    );


    public function actionIndex()
    {
        if (Yii::app()->request->getPost('ok'))
            $this->redirect($this->createUrl('createdb'));
        $this->render('index');

    }

    public function actionCreatedb()
    {
        $model = new InstallConfigureForm;

        if ($_POST['InstallConfigureForm']['deleteData'] == "da") {
            $model->attributes = $_POST['InstallConfigureForm'];
            $model->dbType = Yii::app()->session['dbType'];
            $model->dropDb();
            $model->importSqlDump();
            $model->oweriteMainFile($model->dbType, $model->port);
            $model->writeConnectionSettings();
            $this->redirect($this->createUrl('finish'));
        }

        if ($_POST['InstallConfigureForm']['deleteData'] == "nu") {
            $this->redirect($this->createUrl('finish'));
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['InstallConfigureForm'])) {
            $model->attributes = $_POST['InstallConfigureForm'];

            if ($model->validate()) {
                if ($model->createDb($_POST['InstallConfigureForm']['dbName'])) {
                    if ($_POST['InstallConfigureForm']['restoreData']) {
                        $model->writeConnectionSettings();
                        $model->oweriteMainFile($model->dbType, $model->port);
                        $model->importSqlDump();
                    }
                    $this->redirect($this->createUrl('finish'));
                } else {
                    Yii::app()->session['dbType'] = $model->dbType;
                    $msg = "<h2>Baza de date exista deja</h2>";
                    $flag = true;
                    $this->render('createdb', array('model' => $model, 'msg' => $msg, 'flag' => $flag));
                    exit();
                }
            }
        }

        $this->render('createdb', array('model' => $model,));
    }


    public function actionFinish()
    {
        if (isset($_POST['Finish']))
            $this->redirect($this->createUrl('../../site/index'));

        $this->render('finish');
    }

    public function actionCompleted()
    {
        $this->render('completed');
    }


    public function isWritable($path)
    {
        $fullPath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $path;
        return is_writable($fullPath);
    }

}
