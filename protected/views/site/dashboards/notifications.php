<?php if (!isset(Yii::app()->modules['Task']))
    echo Yii::t('mess','Modulul Task nu este activat');
else {
    $is_notif = '1';

    $this->renderPartial('Task.views.dashboards.list', [
        'type' => 'i',
        'curr_is_notif' => $is_notif,
    ]);
}