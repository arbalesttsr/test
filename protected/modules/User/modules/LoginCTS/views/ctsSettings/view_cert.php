<?php
/* @var $this CtsSettingsController */
/* @var $model CtsSettings */

$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    'LoginCTS' => array("User/LoginCTS/default/administration"),
    Yii::t('mess','Manage Cts Settings') => array("User/LoginCTS/ctsSettings/admin"),
    Yii::t('mess','View Certificates Contents') .' #' . $model->id
);

$this->menu = array(
    //array('label'=>'List CtsSettings', 'url'=>array('index')),
    array('label' => Yii::t('mess','Create Cts Settings'), 'url' => array('create')),
    array('label' => Yii::t('mess','Update CtsSettings'), 'url' => array('update', 'id' => $model->id)),
    //array('label'=>'Delete CtsSettings', 'url'=>'#', 'htmlOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label' => Yii::t('mess','Manage Cts Settings'), 'url' => array('admin')),

);
?>
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4><?= Yii::t('mess','View Certificates Contents') ?></h4>
            <div class="options">
                <a href="#"><i class="fa fa-download"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="accordioninpanel" class="accordion-group">
                <div class="accordion-item">
                    <a class="accordion-title collapsed" data-toggle="collapse" data-parent="#accordioninpanel"
                       href="#collapseinOne"><h4><strong><?php echo $model->key; ?></strong> <?= Yii::t('mess','file content') ?></h4></a>
                    <div id="collapseinOne" class="collapse in">
                        <div class="accordion-body"><?php echo $key; ?></div>
                    </div>
                </div>
                <div class="accordion-item">
                    <a class="accordion-title collapsed" data-toggle="collapse" data-parent="#accordioninpanel"
                       href="#collapseinTwo"><h4><strong><?php echo $model->certificate; ?></strong><?= Yii::t('mess','file content') ?></h4>
                    </a>
                    <div id="collapseinTwo" class="collapse in">
                        <div class="accordion-body "><?php echo $certificate; ?></div>
                    </div>
                </div>
                <div class="accordion-item">
                    <a class="accordion-title" data-toggle="collapse" data-parent="#accordioninpanel"
                       href="#collapseinThree"><h4><strong><?php echo $model->validate_response_key; ?></strong> 
						<?= Yii::t('mess','file content') ?></h4></a>
                    <div id="collapseinThree" class="collapse in">
                        <div class="accordion-body"><?php echo $validate_response_key; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>