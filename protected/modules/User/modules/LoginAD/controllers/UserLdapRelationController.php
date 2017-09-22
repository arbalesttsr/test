<?php

class UserLdapRelationController extends Controller
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
     * @return UserLdapRelation the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = UserLdapRelation::model()->findByPk($id);
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
        $model = new UserLdapRelation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserLdapRelation'])) {
            $model->attributes = $_POST['UserLdapRelation'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['UserLdapRelation'])) {
            $model->attributes = $_POST['UserLdapRelation'];
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
        $dataProvider = new CActiveDataProvider('UserLdapRelation');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new UserLdapRelation('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UserLdapRelation']))
            $model->attributes = $_GET['UserLdapRelation'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionTest()
    {
        $ldaprdn = 'uid=tudor,cn=users,dc=HOSTNAME,dc=DOMAIN,dc=com';     // ldap rdn or dn
        $ldappass = 'PASSWORD';  // associated password

        // connect to ldap server
        $ldapconn = ldap_connect("192.168.14.101", 389)
        or die("Could not connect to LDAP server.");

        // Set some ldap options for talking to
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        if ($ldapconn) {

            // binding to ldap server
            $ldapbind = @ldap_bind($ldapconn, 'nippon//tudor', '131VBN$$');

            // verify binding
            if ($ldapbind) {
                echo "LDAP bind successful...\n";
            } else {
                echo "LDAP bind failed...\n";
            }

        }
    }

    /**
     * Performs the AJAX validation.
     * @param UserLdapRelation $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-ldap-relation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
