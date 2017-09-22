<?php
/* @var $this LoginExceptionController */
/* @var $model LoginException */


$this->menu = [
    ['label' => 'Lista Exceptii', 'icon' => 'list', 'url' => ['admin']],
];
$this->breadcrumbs = [
    'Manage Modules' => ["modulesData/admin"],
    'Exceptii logare' => ['loginException/admin'],
    'Creare Exceptie Logare'
];

?>

    <div class="page-header">
        <h1>Creare Exceptie Logare</h1>
    </div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>