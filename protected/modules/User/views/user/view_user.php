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
                            <?= Profile::getProfileAvatar($model->id, '100*100') ?>
                        </div>
                        <div class="table-responsive">
                            <h3><strong><?= $model->full_name ?></strong></h3>
                            <table class="table table-condensed">

                                <tbody>
                                <tr>
                                    <td><?= $model->getAttributeLabel('id') ?></td>
                                    <td><?= $model->id ?></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('username') ?></td>
                                    <td><?= $model->username ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('idnp') ?></td>
                                    <td><?= $model->idnp ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('ad_username') ?></td>
                                    <td><?= $model->ad_username ?></td>
                                </tr>

                                <tr>
                                    <td><?= $model->getAttributeLabel('status_id') ?></td>
                                    <td><?= CHtml::encode($model->getUserStatusText()) ?></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('sql_user') ?></td>
                                    <td><?= ($model->sql_user !== 0) ? 'Active' : 'Not Active' ?></td>
                                </tr>
                                <tr>
                                    <td><?= $model->getAttributeLabel('penalization') ?></td>
                                    <td><?= !is_null($model->penalization) ? 'Yes ' . CHtml::button('Unlock', array('submit' => array('user/UnlockPenalization', 'id' => $model->id), 'class' => 'btn btn-info btn-label')) : 'No' ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3><?= Yii::t('mess','Additional Information') ?></h3>
                        <table class="table table-condensed">
                            <tbody>

                            <tr>
                                <td><?= $model->getAttributeLabel('create_user_id') ?></td>
                                <td><?= User::model()->findByPk($model->create_user_id)->username ?></td>
                            </tr>

                            <tr>
                                <td><?= $model->getAttributeLabel('create_datetime') ?></td>
                                <td><?= $model->create_datetime ?></td>
                            </tr>

                            <tr>
                                <td><?= $model->getAttributeLabel('update_user_id') ?></td>
                                <td><?= $model->update_user_id ?></td>
                            </tr>

                            <tr>
                                <td><?= $model->getAttributeLabel('update_datetime') ?></td>
                                <td><?= $model->update_datetime ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
