<?php
/**
 * @var $this ProfileController
 * @var $model FieldForm
 * @var $columns
 */

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'MANAGE_PROFILES'), 'url' => array('/User/user/userDetailsUpdate', 'id' => Yii::app()->user->id)),
    array('label' => Yii::t('UserModule.t', 'USERS'), 'url' => array('/User/user/admin')),
);
?>

<div class="page-header">
    <h4><?php echo Yii::t('UserModule.t', 'ADDITIONAL_FIELDS') ?></h4>
</div>

<table class="table table-condensed">
    <tbody>
    <?php foreach ($columns as $column => $label) {
        if ($column === 'id' or $column === 'user_id')
            continue;
        echo '<tr><td>' . CHtml::encode($label) . '</td></tr>'; ?>

    <?php } ?>
    </tbody>
</table>


<?php
$this->widget('application.components.widgets.usertheme.UserButton', array(
    'label' => Yii::t('mess', 'add'),
    'type' => 'success',
    'icon' => 'circle_plus',
    'url' => '#',
    'htmlOptions' => array('class' => 'add-new-field')));
?>

<?php
if ($columns) {
    $this->widget('application.components.widgets.usertheme.UserButton', array(
        'label' => Yii::t('mess', 'delete'),
        'type' => 'info',
        'icon' => 'circle_minus',
        'url' => '#',
        'htmlOptions' => array('class' => 'delete-field')));
}
?>

<?php
$this->renderPartial('_addFieldModalForm', array('model' => $model, 'columns' => $columns));
$this->renderPartial('_deleteFieldModalForm', array('model' => $model, 'columns' => $columns));
?>
