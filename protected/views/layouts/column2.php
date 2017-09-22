<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="span-22">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<div class="span-6 last">
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', [
            'title' => 'Operations',
        ]);
        $this->widget('zii.widgets.CMenu', [
            'items' => $this->menu,
            'htmlOptions' => ['class' => 'operations'],
        ]);
        $this->endWidget();

        ?>
    </div><!-- sidebar -->

</div>
<?php
if (isset(Yii::app()->modules['InterfacesWidget']))
    $this->widget('InterfacesWidget.components.interfaces_widgets.UserMonitoring'); ?>
<?php $this->endContent(); ?>
