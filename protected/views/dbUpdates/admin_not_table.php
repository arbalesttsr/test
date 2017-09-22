<?php
/* @var $this DbUpdatesController */
/* @var $models DbUpdates */

$this->breadcrumbs = [
    'Actualizari BD',
]; ?>

<div class="page-header">
    <h1>Administrare Actualizari BD</h1>
</div>

<div class="alert alert-dismissable alert-warning">
    <strong>Warning!</strong> Tabela pentru monitorizarea actualizarior tabelelor nu a fost gasita.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <a class="btn btn-info btn-xs"
       href="<?= Yii::app()->createUrl('dbUpdates/executeFile', ['filename' => DbUpdates::FIRST_TABLE_SQL_NAME]); ?>">Creare
        Tabela</a>
</div>
