<?php if (!isset(Yii::app()->modules['Report']))
    echo Yii::t('mess','Modulul Report nu este activat');
else {
    $this->renderPartial('Report.views.dashboards.list');
}