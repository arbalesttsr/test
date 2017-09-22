<?php

$user = User::model()->findByPk($model->user_id);
?>
<div class="page-header">
    <h5><?php echo Yii::t('UserModule.t', 'BASE_INFO'); ?></h5>
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
                                    <td colspan="2"><h5 style="text-align: center;">
                                            <strong><?php echo Yii::t('mess', 'Restricted By Time') ?></strong>
                                        </h5></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('date_start') ?></td>
                                    <td><?= !is_null($model->date_start) ? $model->date_start : 'Not Set' ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('time_limit') ?></td>
                                    <td><?= !is_null($model->time_limit) ? $model->time_limit : 'Not Set' ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><h5 style="text-align: center;">
                                            <strong><?php echo Yii::t('mess', 'Restricted By Date') ?></strong>
                                        </h5></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('restricted_date') ?></td>
                                    <td><?= !is_null($model->restricted_date) ? $model->restricted_date : 'Not Set' ?></td>
                                </tr>


                                <tr>
                                    <td colspan="2"><h5 style="text-align: center;">
                                            <strong><?php echo Yii::t('mess', 'Restricted By Interval') ?></strong>
                                        </h5></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('restricted_interval') ?></td>
                                    <td><?= !is_null($model->restricted_interval) ? $model->restricted_interval : 'Not Set' ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('start_time') ?></td>
                                    <td><?= !is_null($model->start_time) ? $model->start_time : 'Not Set' ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('end_time') ?></td>
                                    <td><?= !is_null($model->end_time) ? $model->end_time : 'Not Set' ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3><?= Yii::t('mess','Additional Information') ?></h3>
                        <p>...</p>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
