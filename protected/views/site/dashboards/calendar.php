<?php if (!isset(Yii::app()->modules['Task']))
    echo Yii::t('mess','Modulul Task nu este activat');
else {
    $this->renderPartial('Task.views.dashboards.calendar', ['user_id' => Yii::app()->user->id]);
}