<?php
if (!isset(Yii::app()->modules['Documents']))
    echo Yii::t('mess','Modulul Documents nu este activat');
else {
    if (isset($folder_id) && $folder_id != '')
        $this->renderPartial('Documents.views.dashboards.tree_folder', ['folder_id' => $folder_id, 'uniq_id' => $uniq_id]);
    else echo Yii::t('mess','Alegeti o mapa pentru afisare');
}
?>