<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    'LoginDB' => array("{$this->module->id}/LoginDB/default/administration"),
    Yii::t('UserModule.t', 'MANAGE_SQL_USERS')
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'MANAGE_USERS'), 'icon' => 'list', 'url' => array('admin'), 'visible' => Yii::app()->user->isSa()),
);

?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t', 'MANAGE_SQL_USERS'); ?></h1>
</div>


<?php $this->widget('application.components.widgets.usertheme.AvantGridView', array(
    'id' => 'user-grid',
    'hide_btns' => true,
    'dataProvider' => $user->search(),
    'filter' => $user,
    'columns' => array(
        //'id',
        'username',
        array(
            'header' => Yii::t('mess','Db Sql Username'),
            'name' => 'sql_user',
            'value' => 'User::GetDbSqlUsername($data->username)',
        ),
        'sql_user' => array(
            // 'header' => 'Status',
            'name' => 'sql_user',
            'value' => '($data->sql_user ===1)? "Yes" : "Not Active"',
        ),
        array(
            'class' => 'zii.widgets.grid.CButtonColumn',
            'template' => '{create}{deleteSql}{activate}{block}',
            'buttons' => array(
                'create' => array(
                    'url' => 'Yii::app()->createUrl("User/user/createSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-plus-circle", 'title' => Yii::t('mess', 'ADD_SQL_USER')),
                    'label' => '',
                    'visible' => '(User::GetDbSqlUsername($data->username)==="Not Set" && Yii::app()->getUser()->isSa())?true:false;'
                ),
                'deleteSql' => array(
                    'url' => 'Yii::app()->createUrl("User/user/deleteSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-remove", 'title' => Yii::t('mess', 'delete')),
                    'label' => '',
                    'visible' => '(User::GetDbSqlUsername($data->username)!=="Not Set" && Yii::app()->getUser()->isSa())?true:false;'
                ),
                'activate' => array(
                    'url' => 'Yii::app()->createUrl("User/user/activateSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#85c744;', 'class' => "fa fa-check-square", 'title' => Yii::t('mess', 'ACTIVATE')),
                    'label' => '',
                    'visible' => '($data->sql_user===0 && Yii::app()->getUser()->isSa())?true:false;'
                ),
                'block' => array(
                    'url' => 'Yii::app()->createUrl("User/user/disableSqlUser", array("id"=>$data->id))',
                    'options' => array('style' => 'color:#e73c3c;', 'class' => "fa fa-ban", 'title' => Yii::t('mess', 'DISABLE')),
                    'label' => '',
                    'visible' => '($data->sql_user===1 && Yii::app()->getUser()->isSa())?true:false;'
                ),

            ),
            'htmlOptions' => array('style' => 'width: 50px'),
        )
    ),
)); ?>
