<ul class="breadcrumb">
    <li><a href="<?php echo Yii::app()->homeUrl ?>"></a>
        <a href="<?php echo Yii::app()->homeUrl ?>" class="glyphicons home"><i></i> <?php echo Yii::app()->name; ?></a>
    </li>
    <?php if (count($this->crumbs)) echo $this->delimiter; ?>
    <?php foreach ($this->crumbs as $key => $crumb) {
        if (!is_numeric($key)) {
            echo '<li>';
            echo !isset($crumb[1]) ? CHtml::link($key, Yii::app()->createUrl($crumb[0])) : CHtml::link($key, Yii::app()->createUrl($crumb[0], $crumb[1]));
            echo '</li>';
        } elseif (is_string($crumb)) {
            echo $crumb;
        }
        if (next($this->crumbs)) {
            echo $this->delimiter;
        }
    } ?>
</ul>