<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs = array(
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('UserModule.t', 'BASE_INFO'),
);

$this->menu = array(
    array('label' => Yii::t('UserModule.t', 'EDIT_PROFILE'), 'icon'=>'edit', 'url' => array('User/profile/edit', 'id' => $model->id)),
    //array('label'=>Yii::t('UserModule.t','DELETE_PROFILE'), 'url'=>'#', 'htmlOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('UserModule.t','Are you sure you want to delete this user?'))),
    array('label' => Yii::t('UserModule.t', 'CHANGE_PASSWORD'), 'icon'=>'key', 'url' => array('User/password/change')),
);

$user = User::model()->findByPk($model->user_id);
?>

    <!--div class=""-->
    <div class="page-header">
        <h1><?php echo Yii::t('UserModule.t', 'BASE_INFO'); ?></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-midnightblue">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div style="float: left; margin: 0 20px 20px 0;">
                                <?= Profile::getProfileAvatar($user->id, '100*100') ?>
                            </div>
                            <div class="table-responsive">
                                <h3><strong><?= $user->full_name ?></strong></h3>
                                <table class="table table-condensed">

                                    <tbody>

                                    <tr>
                                        <td><?= $user->getAttributeLabel('username') ?></td>
                                        <td><?= $user->username ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('email') ?></td>
                                        <td><a href="mailto:<?= $model->email ?>"><?= $model->email ?></a></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('gender') ?></td>
                                        <td><?= Profile::model()->getGender($model->gender) ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('birthday') ?></td>
                                        <td><?= $model->birthday ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('phone') ?></td>
                                        <td><?= $model->phone ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('mobile') ?></td>
                                        <td><?= $model->mobile ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('subsidiary_id') ?></td>
                                        <td><?= UserProvider::getSubsidiaryName($model->subsidiary_id) ?></td>
                                    </tr>

                                    <tr>
                                        <td><?= $model->getAttributeLabel('department_id') ?></td>
                                        <td><?= UserProvider::getDepartmentName($model->department_id) ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3><?= $model->getAttributeLabel('about') ?></h3>
                            <p>
                                <?= $model->about ?>
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php /* ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'firstname',
		'lastname',
		'patronymic',
		'email',
		'birthday',
		'gender'=>array(
			'name' => 'gender',
			'value' => $model->getGender($model->gender)
		),
		'about',
		//'update_datetime',
	),
)); ?>

<div class="page-header">
    <h1><?php echo Yii::t('UserModule.t','ADD_INFO'); ?></h1>
</div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'subsidiary_id'=>array(
				'name'=>'subsidiary_id',
				'value'=>UserProvider::getSubsidiaryName($model->subsidiary_id),
		),
		'department_id'=>array(
				'name'=>'department_id',
				'value'=>UserProvider::getDepartmentName($model->department_id),
		),
	),
)); ?>
</div>


<div class="span6">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$additionalProfileModel,
	'attributes'=>$additionalProfileModel->getColumnAttributes($additionalProfileModel)
		
)); ?>
</div>

 <?php */ ?>