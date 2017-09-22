<div class="progress">
    1→2→<span class="active">3</span>
</div>

<h1><?php echo Yii::t('InstallModule.core', 'Baza de date a fost creata cu succes<br>') ?></h1>

<div class="line"></div>

<div class="form wide">
    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <input type="submit" name="Finish" value="Finish">

</div>

<?php $this->endWidget(); ?>