<?php $this->beginWidget('application.components.widgets.usertheme.UserModal', array('id' => 'add-new-field-modal')); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 style="margin:0; font-weight: normal;"><?php echo Yii::t('UserModule.t', 'FIELDS') ?></h4>
</div>
<div class="form">
    <div class="modal-body">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'field-form',
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <div class="row" id="fieldType-field">
            <?php echo $form->labelEx($model, 'fieldType'); ?>
            <?php echo $form->dropDownList($model, 'fieldType', $model->getFieldTypes(), array('prompt' => '---')); ?>
            <?php echo $form->error($model, 'fieldType'); ?>
        </div>

        <div class="row" id="place-field" style="display: none">
            <?php echo $form->labelEx($model, 'place'); ?>
            <?php echo $form->dropDownList($model, 'place', array('' => Yii::T('UserModule.t', 'AT_END_OF_TABLE'), 'FIRST' => Yii::T('UserModule.t', 'AT_BEGINNING_OF_TABLE'), 'AFTER' => Yii::T('UserModule.t', 'AFTER'))); ?>
            <?php echo $form->error($model, 'place'); ?>
        </div>

        <div class="row" id="after-field" style="display: none">
            <?php echo $form->labelEx($model, 'after'); ?>
            <?php echo $form->dropDownList($model, 'after', ProfileAdditional::model()->attributeLabels()); ?>
            <?php echo $form->error($model, 'after'); ?>
        </div>

        <div class="row" id="type-field" style="display: none">
            <?php echo $form->labelEx($model, 'type'); ?>
            <?php echo $form->dropDownList($model, 'type', $model->getDbTypes(), array('prompt' => '---')); ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>

        <div class="row" id="length-field" style="display: none">
            <?php echo $form->labelEx($model, 'length'); ?>
            <?php echo $form->numberField($model, 'length', array('step' => 'any')); ?>
            <?php echo $form->error($model, 'length'); ?>
            <p></p>
        </div>

        <div class="row" id="refTable-field" style="display: none">
            <?php echo $form->labelEx($model, 'refTable'); ?>
            <?php echo $form->dropDownList($model, 'refTable', ProfileAdditional::model()->getTableNames(), array('prompt' => '---',
                'onChange' => CHtml::ajax(array(
                    'dataType' => 'html',
                    'type' => 'POST',
                    'url' => Yii::app()->createUrl('User/profile/getColumns'),
                    'update' => '#' . CHtml::activeId($model, 'refColumn')
                )))); ?>
            <?php echo $form->error($model, 'refTable'); ?>
        </div>

        <div class="row" id="refColumn-field" style="display: none">
            <?php echo $form->labelEx($model, 'refColumn'); ?>
            <?php echo $form->dropDownList($model, 'refColumn', array(), array('prompt' => '---')); ?>
            <?php echo $form->error($model, 'refColumn'); ?>
        </div>

        <div class="row" id="values-field" style="display: none">
            <?php echo $form->labelEx($model, 'values'); ?>
            <?php echo $form->textField($model, 'values'); ?>
            <?php echo $form->error($model, 'values'); ?>
            <p class="hint"><?= Yii::t('mess','Write values as: value1,value2,value3...valueN') ?></p>
        </div>

        <div class="row" id="name-field" style="display: none">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?><span class="hint"></span>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row" id="default-value-field" style="display: none">
            <?php echo $form->labelEx($model, 'defaultValue'); ?>
            <?php echo $form->textField($model, 'defaultValue'); ?>
            <?php echo $form->error($model, 'defaultValue'); ?>
            <p class="hint">
                <?= Yii::t('mess','You may write "CURRENT_TIMESTAMP" or your own "value", without any quotes.') ?>
            </p>
        </div>

    </div>
    <div class="modal-footer">
        <?php echo CHtml::button(Yii::t('mess', 'cancel'), array('class' => 'btn', 'data-dismiss' => 'modal', 'aria-hidden' => 'true')) ?>
        <?php echo CHtml::submitButton(Yii::t('mess', 'add'), array('class' => 'btn btn-primary')); ?>
        <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
    </div>

    <?php $this->endWidget(); ?><!-- CActiveForm -->
</div><!-- form -->
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $('.add-new-field').click(function () {
        $('#add-new-field-modal').modal();
        return false;
    });

    $('#add-new-field-modal').on('show.bs.modal', function () {
        $(this).insertBefore('#content').removeClass('hide');
    });

    var fields = {
        hide: '#values-field,#length-field',
        textField: {
            type: ['VARCHAR'],
        },
        textArea: {
            type: ['TEXT'],
        },
        dateField: {
            type: ['DATE'],
        },
        dropDownList: {
            type: ['FROM_ANOTHER_TABLE'],
        },
        numberField: {
            type: ['INT', 'BIGINT', 'DECIMAL'],
        },
        checkBox: {
            type: ['INT'],
        },
    };

    var types = {
        ENUM: {
            show: '#values-field',
            hint: 'write values as: value1,value2,value3...valueN'
        },
        INT: {
            //show:'#length-field',
            //defaultLength:11,
            values: true,
        },
        BIGINT: {
            //show:'#length-field',
            //defaultLength:11,
            values: true,
        },
        DECIMAL: {
            show: '#length-field',
        },
        TINYINT: {
            show: '',
            defaultLength: 1
        },
        VARCHAR: {
            show: '#length-field',
            defaultLength: 255,
            values: true,
        },
        DATE: {
            show: '',
        },
    };

    fieldsToShow = '#place-field,#name-field,#type-field,#length-field,#values-field,#index-field,#default-value-field';

    $('#FieldForm_fieldType').change(function () {

        $('#FieldForm_fieldType').each(function () {
            $(fieldsToShow).hide();
            var field = fields[$(this).val()];
            if (field) {
                $(fieldsToShow).show();
                $(fields.hide).hide();
                //---------
                $('#type-field select').empty();
                $('#type-field select').append('<option value>---</option>');
                if (field.type) {
                    var types = field.type;
                    for (var i = 0; i < types.length; i++) {
                        $('#type-field select').append('<option value=\"' + types[i] + '\">' + types[i] + '</option>');
                    }
                }
            }
        });

        $('#FieldForm_refColumn').change(function () {
            $('#FieldForm_refColumn').each(function () {
                if ($(this).val()) {
                    $('#name-field input').val($(this).val());
                }
                $('#FieldForm_name').change(function () {
                    if ($(this).val() !== $('#FieldForm_refColumn').val()) {
                        alert('Leave the name as the ref column name!');
                        $(this).val($('#FieldForm_refColumn').val());
                    }
                });
            });
        });

    });

    $('#FieldForm_type').change(function () {
        $('#FieldForm_type').each(function () {
            $('#length-field input').val('');
            $('#name-field input').val('');
            if (types[$(this).val()]) {
                if (types[$(this).val()].defaultLength) {
                    var value = types[$(this).val()].defaultLength;
                    $('#length-field input').val(value);
                }
            }
        });
        //----------
        $('#FieldForm_type').each(function () {
            if (types[$(this).val()]) {
                $('#values-field,#length-field').hide();
                var type = types[$(this).val()];
                $(type.show).show();
            }
            $('#refTable-field,#refColumn-field,#values-field').hide();
            if ($('#FieldForm_fieldType').val() === 'dropDownList' && $(this).val() == 'FROM_ANOTHER_TABLE') {
                $('#refTable-field,#refColumn-field').show();
                $('#default-value-field').hide();
            }
            if ($(this).val() == 'ENUM') {
                $('#values-field').show();
            }
        });
    });

    $('#FieldForm_place').change(function () {
        $('#FieldForm_place').each(function () {
            $('#after-field').hide();
            if ($(this).val() == 'AFTER') {
                $('#after-field').show();
            }
        });
    });
</script>