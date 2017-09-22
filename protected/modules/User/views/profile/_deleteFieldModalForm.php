<?php $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => 'delete-field-modal')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 style="margin:0; font-weight: normal;"><?php echo Yii::t('UserModule.t', 'DELETE_FIELD') ?></h4>
</div>
<div class="form">
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'delete-field-form',
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'action' => 'deleteField',
        )); ?>

        <div class="row" id="name-field">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->dropDownList($model, 'name', $columns, array('prompt' => '---')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="modal-footer">
        <?php echo CHtml::button(Yii::t('mess', 'cancel'), array('class' => 'btn', 'data-dismiss' => 'modal', 'aria-hidden' => 'true')) ?>
        <?php echo CHtml::submitButton(Yii::t('mess', 'delete'), array('class' => 'btn btn-primary', 'confirm' => Yii::t('UserModule.t', 'Are you sure you want to delete this item?'))); ?>
        <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
    </div>
    <?php $this->endWidget(); ?><!-- CActiveForm -->
</div><!-- form -->
<?php $this->endWidget(); ?>

<script type="text/javascript">

    $('.delete-field').click(function () {
        $('#delete-field-modal').modal();
        return false;
    });

    $('#delete-field-modal').on('show.bs.modal', function () {
        $(this).insertBefore('#content').removeClass('hide');
    });

</script>