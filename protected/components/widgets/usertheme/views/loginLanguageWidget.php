<div class="btn-group" style="background-color: #fff; border: 1px solid #fefefe; margin-bottom: 5px;">
    <a href="?language=<?= $this->currentLang; ?>" class="btn btn-default-alt">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/lang/<?php echo $this->currentLang; ?>.png"
             alt="<?php echo $this->currentLang; ?>" style="height: 15px; width: 15px; margin: 0 10px 0 0;"/>
        <?php echo isset($this->languages, $this->languages[$this->currentLang]) ? $this->languages[$this->currentLang] : ''; ?>
    </a>
    <a href="#" class="btn btn-default-alt dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
    <ul class="dropdown-menu module-menu">
        <?php foreach ($this->languages as $key => $lang) { ?>
            <?php $class = ''; ?>
            <?php if ($key == $this->currentLang) $class = 'active'; ?>
            <li class="<?php echo $class; ?>">
                <a href="?language=<?= $key; ?><?php //echo $this->getOwner()->createMultilanguageReturnUrl($key); ?>"
                   title="<?php echo $lang; ?>">
                    <?php echo $lang; ?>
                    <img class="pull-right"
                         src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/lang/<?php echo $key; ?>.png"
                         alt="<?php echo $lang; ?>">
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
