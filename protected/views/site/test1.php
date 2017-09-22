<h2>Users Online</h2>
<?php
$online_users = User::getOnlineUsers();
if (isset($online_users) && is_array($online_users) && !empty($online_users)) {
    foreach ($online_users as $user)
        if (isset($user)) {
            var_dump($user);
            $user = User::model()->findByPk($user['id']);
            //echo '<p>' . $user->full_name . '</p>';
        }
} else {
    echo 'none';
}
?>


<?php echo '<h1>Test1</h1>';

$model = new ModulesData('search');
//$this->widget('zii.widgets.grid.CGridView', array(
$this->widget('application.components.widgets.usertheme.AvantGridView', [
    'id' => '',
    //'class'=>'',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => ['id', 'name']
]);