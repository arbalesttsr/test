<?php
/* @var $this DbUpdatesController */
/* @var $models DbUpdates */

$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Actualizari BD',
]; ?>

<div class="page-header">
    <h1>Administrare Actualizari BD</h1>
</div>
<?php $dumps_path = DbUpdates::getUpdatesFilepath();
if (!is_dir($dumps_path)) { ?>
    <div class="alert alert-dismissable alert-warning">
        <strong>Warning!</strong> Folderul pentru pastrarea actualizarilor bazelor de date nu exista.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <a class="btn btn-info btn-xs" href="<?= Yii::app()->createUrl('dbUpdates/createFolder'); ?>">Creare
            Directoriu</a>
    </div>
<?php } else {
    $db_files = [];
    if ($handle = opendir($dumps_path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $db_files[] = $entry;
                $tryModel = DbUpdates::model()->findByAttributes(['filename' => $entry]);
                if (is_null($tryModel)) { ?>
                    <div class="alert alert-dismissable alert-info">
                        <strong>Info!</strong> Fisierul <b><?= $entry ?></b> nu a fost executat.
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <a class="btn btn-info btn-xs"
                           href="<?= Yii::app()->createUrl('dbUpdates/executeFile', ['filename' => htmlspecialchars($entry)]); ?>">Executare
                            Fisier</a>
                    </div>
                <?php }
            }
        }
        closedir($handle);
    }
} ?>
<?php $this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => 'dbupdates-grid',
    'dataProvider' => $model->search(),
    //'filter'=>$model,
    'columns' => [
        'id',
        'filename',
        [
            'name' => 'executed',
            'type' => 'raw',
            'value' => '$data->executed0->username',
        ],
        /*array(
            'name' => 'type',
            'value' => '$data->type == 1 ? "Fara Parametri" : "Cu Parametri"',
        ),
        array(
            'name' => 'create_user_id',
            'value' => 'CHtml::encode($data->userCreate->username)',
        ),*/
    ],
]); ?>
