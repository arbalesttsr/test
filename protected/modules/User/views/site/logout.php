<div class="" id="cts-form-container">
    <?php $form = $this->beginWidget('CActiveForm', array( //forma CTS
        'id' => 'cts-form',
        'action' => $cts->getLogoutUrl(),
        'htmlOptions' => array('class' => '')
    ));


    ?>
    <?php echo CHtml::hiddenField('SAMLRequest', $cts->getRequestData(true)); ?>
    <?php echo CHtml::hiddenField('RelayState', $cts->getRelay()); ?>
    <p>
        <strong>Note:</strong>
        Since your browser does not support Javascript, please click the Continue button once to proceed.
    </p>
    <div class="panel-footer">
        <?php echo CHtml::submitButton(Yii::t('label', 'DEAUTHENTICATE'), array('class' => 'btn btn-large btn-primary pull-right')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
