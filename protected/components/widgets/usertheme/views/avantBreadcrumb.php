<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->homeUrl ?>"></a>
        <a href="<?php echo Yii::app()->homeUrl ?>"><i class="fa fa-home"></i><?php echo Yii::app()->name; ?></a>
    </li>
    <?php //if(count($this->crumbs) == 1) echo $this->delimiter; ?>
    <?php foreach ($this->crumbs as $key => $crumb) {
        if (!is_numeric($key)) {
            echo '<li>';
            echo !isset($crumb[1]) ? CHtml::link($key, Yii::app()->createUrl($crumb[0])) : CHtml::link($key, Yii::app()->createUrl($crumb[0], $crumb[1]));
            echo '</li>';
        } elseif (is_string($crumb)) {
            echo '<li><span>' . $crumb . '</span></li>';
        }
        //if(next($this->crumbs)) {
        //echo $this->delimiter;
        //}
    } ?>
    <?php Yii::app()->clientScript->registerCss('breadcrumbs-design', '
        ul.breadcrumb a, ul.breadcrumb span {font-size: 13px;}
        ul.breadcrumb a i:before{margin-right: 5px;}'); ?>
</ul>