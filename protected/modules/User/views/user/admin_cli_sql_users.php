<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('UserModule.t', 'MANAGE_CLI_SQL_USERS')
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon' => 'list', 'url' => array('admin'), 'visible' => Yii::app()->user->isSa()),
);

?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'MANAGE_CLI_SQL_USERS'); ?></h1>
</div>
<?php
if ($client_sql_user === 1) {
    ?>
    <div class="alert alert-dismissable alert-info">
        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
        <!--            <h3>Heads up!</h3> -->
        <p><?= Yii::t('mess','Utilizatorul Db Sql pentru Clienti Exista') ?></p>
        <!--<br>-->
        <p><a class="btn btn-danger" href="<?php echo Yii::app()->createUrl("User/user/deleteClientDbSql"); ?>"><?= Yii::t('mess','Delete Client Sql User') ?></a></p>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dismissable alert-warning">
        <strong><?= Yii::t('mess','atentie') ?></strong> <?= Yii::t('mess','Utilizatorul Db Sql pentru Clienti nu este creat, accesati butonul Create pentru a-l crea!') ?>

        <p><a class="btn btn-success" href="<?php echo Yii::app()->createUrl("User/user/clientDbSqlCreate"); ?>"><?= Yii::t('mess','Create Db Sql User') ?></a></p>
    </div>

    <?php
}
?>


<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'user-grid',
    'hide_btns' => true,
    'dataProvider' => $user->search(),
    'filter' => $user,
    'columns' => array(
        'username',
        array(
            'header' => Yii::t('mess','Db Sql Username'),
            'name' => 'sql_user',
            'value' => '(User::GetCliDbSqlUsername()!=="Not Set")?"User Exists" :"Not Set" ',
        ),

        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{activate}{block}',
            'buttons' => array(
                'activate' => array(
                    'url' => 'Yii::app()->createUrl("User/Client/setSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-check-square", 'title' => Yii::t('mess', 'ACTIVATE')),
                    'label' => '',
                    'visible' => '($data->sql_user===0 && Client::GetDbSqlUsername($data->username)!=="Not Set" && Yii::app()->getUser()->isSa())?true:false;'
                ),
                'block' => array(
                    'url' => 'Yii::app()->createUrl("User/Client/deleteSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#e73c3c;', 'class' => "fa fa-ban", 'title' => Yii::t('mess', 'DISABLE')),
                    'label' => '',
                    'visible' => '($data->sql_user===1 && Client::GetDbSqlUsername($data->username)!=="Not Set" && Yii::app()->getUser()->isSa())?true:false;'
                ),

            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
