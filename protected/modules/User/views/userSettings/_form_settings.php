<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-settings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>
    <div class="tab-container tab-left tab-danger">

        <p class="note"><?= Yii::t('mess', 'The fields with') ?> <span class="required">*</span><?= Yii::t('mess', 'are required') ?> </p>

        <?php echo $form->errorSummary($model); ?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#bytime" data-toggle="tab"><?= Yii::t('mess','Restricted By Time') ?></a></li>
            <li class=""><a href="#bydate" data-toggle="tab"><?= Yii::t('mess','Restricted By Date') ?></a></li>
            <li class=""><a href="#byinterval" data-toggle="tab"><?= Yii::t('mess','Restricted By Interval') ?></a></li>
            <li class=""><a href="#holiday" data-toggle="tab"><?= Yii::t('mess','Restricted Dates Holidays') ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="bytime">
                <!--<p class="note">Restrictionati utilizatorul dupa timp . Setati mai intii data inceput si timp in minute cit va avea utilizatorul acces la sistem</p>-->
                <div class="alert alert-dismissable alert-warning">
                    <strong><?= Yii::t('mess','Restrictionati utilizatorul dupa timp') ?></strong> <?= Yii::t('mess','timeAllert') ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'date_start'); ?>
                    <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                        'model' => $model,
                        'attribute' => 'date_start',
                        'mode' => 'datetime',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'timeFormat' => 'hh:mm:ss',//'hh:mm tt' default
                        ),

                    ));
                    //echo $form->dateField($model, 'date_start'); ?>
                    <?php echo $form->error($model, 'date_start'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'time_limit'); ?>
                    <?php echo $form->numberField($model, 'time_limit', array('size' => 20, 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'time_limit'); ?>
                </div>

            </div>
            <div class="tab-pane" id="bydate">
                <div class="alert alert-dismissable alert-warning">
                    <strong><?= Yii::t('mess','Restrictionati utilizatorul dupa data') ?></strong> <?= Yii::t('mess','dataAllert') ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'restricted_date'); ?>
                    <?php echo $form->dateField($model, 'restricted_date'); ?>
                    <?php //echo $form->textField($model, 'restricted_date', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'restricted_date'); ?>
                </div>

            </div>
            <div class="tab-pane" id="byinterval">
                <div class="alert alert-dismissable alert-warning">
                    <strong><?= Yii::t('mess','Restrictionati utilizatorul dupa interval') ?></strong>  <?= Yii::t('mess','intervalAllert') ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'restricted_interval'); ?>
                    <?php echo $form->dateField($model, 'restricted_interval', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'restricted_interval'); ?>
                </div>


                <div class="row">
                    <?php echo $form->labelEx($model, 'start_time'); ?>
                    <?php
                    $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'start_time',
                        'mask' => '99:99',
                        'htmlOptions' => array('size' => 60,)
                    ));
                    ?>
                    <?php
                    //echo $form->textField($model,'start_time',array('size'=>8,'maxlength'=>10, 'class'=>'hasTimepicker','id'=>'timepicker1'));
                    ?>

                    <?php echo $form->error($model, 'start_time'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'end_time'); ?>
                    <?php
                    $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'end_time',
                        'mask' => '99:99',
                        'htmlOptions' => array('size' => 60,)
                    ));
                    ?>
                    <?php
                    // echo $form->textField($model,'end_time',array('size'=>8,'maxlength'=>10));
                    ?>
                    <?php echo $form->error($model, 'end_time'); ?>
                </div>
            </div>
            <div class="tab-pane" id="holiday">

                <div class="alert alert-dismissable alert-warning">
                    <strong><?= Yii::t('mess','Holidays Restriction') ?></strong> <?= Yii::t('mess','holidayAllert') ?><br>
                    <p><a class="btn btn-success"
                          href="<?php echo Yii::app()->createUrl('/User/userSettings/holidaysAdmin'); ?>"> <?= Yii::t('mess','Holidays Manage') ?></a></p>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'holiday_enable'); ?>
                    <?php echo $form->checkBox($model, 'holiday_enable', array('value' => 1, 'uncheckValue' => 0)); ?>
                    <?php echo $form->error($model, 'holiday_enable'); ?>
                </div>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('mess','save')); ?>
            </div>
        </div>


    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->

<div id="ui-timepicker-div" class="ui-timepicker ui-widget ui-helper-clearfix ui-corner-all"
     style="position: absolute; top: 4367px; left: 594px; z-index: 1; display: none;">
    <table class="ui-timepicker-table ui-widget-content ui-corner-all">
        <tbody>
        <tr>
            <td class="ui-timepicker-hours">
                <div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">Hour</div>
                <table class="ui-timepicker">
                    <tbody>
                    <tr>
                        <th rowspan="2" class="periods" scope="row">AM</th>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="0"><a
                                class="ui-state-default ">00</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="1"><a
                                class="ui-state-default ">01</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="2"><a
                                class="ui-state-default ">02</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="3"><a
                                class="ui-state-default ">03</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="4"><a
                                class="ui-state-default ">04</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="5"><a
                                class="ui-state-default ">05</a></td>
                    </tr>
                    <tr>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="6"><a
                                class="ui-state-default ">06</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="7"><a
                                class="ui-state-default">07</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="8"><a
                                class="ui-state-default ">08</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="9"><a
                                class="ui-state-default ">09</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="10"><a
                                class="ui-state-default ">10</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="11"><a
                                class="ui-state-default ">11</a></td>
                    </tr>
                    <tr>
                        <th rowspan="2" class="periods" scope="row">PM</th>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="12"><a
                                class="ui-state-default ">12</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="13"><a
                                class="ui-state-default ">13</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="14"><a
                                class="ui-state-default ">14</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="15"><a
                                class="ui-state-default ">15</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="16"><a
                                class="ui-state-default ">16</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="17"><a
                                class="ui-state-default ">17</a></td>
                    </tr>
                    <tr>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="18"><a
                                class="ui-state-default ">18</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="19"><a
                                class="ui-state-default ">19</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="20"><a
                                class="ui-state-default ui-state-active">20</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="21"><a
                                class="ui-state-default ">21</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="22"><a
                                class="ui-state-default ">22</a></td>
                        <td class="ui-timepicker-hour-cell" data-timepicker-instance-id="#timepicker1" data-hour="23"><a
                                class="ui-state-default ">23</a></td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td class="ui-timepicker-minutes">
                <div class="ui-timepicker-title ui-widget-header ui-helper-clearfix ui-corner-all">Minute</div>
                <table class="ui-timepicker">
                    <tbody>
                    <tr>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="0"><a class="ui-state-default ">00</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="5"><a class="ui-state-default ">05</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="10"><a class="ui-state-default ">10</a></td>
                    </tr>
                    <tr>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="15"><a class="ui-state-default ui-state-active">15</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="20"><a class="ui-state-default ">20</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="25"><a class="ui-state-default ">25</a></td>
                    </tr>
                    <tr>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="30"><a class="ui-state-default ">30</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="35"><a class="ui-state-default ">35</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="40"><a class="ui-state-default ">40</a></td>
                    </tr>
                    <tr>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="45"><a class="ui-state-default ">45</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="50"><a class="ui-state-default ">50</a></td>
                        <td class="ui-timepicker-minute-cell" data-timepicker-instance-id="#timepicker1"
                            data-minute="55"><a class="ui-state-default ">55</a></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>