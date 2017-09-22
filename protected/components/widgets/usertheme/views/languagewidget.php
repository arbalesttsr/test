<a href="#" data-toggle="dropdown"><img
        src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/lang/<?php echo $this->currentLang; ?>.png"
        alt="<?php echo $this->currentLang; ?>"/></a>
<ul class="dropdown-menu pull-right">
    <?php foreach ($this->languages as $key => $lang) { ?>
        <?php $class = ''; ?>
        <?php if ($key == $this->currentLang) $class = 'active'; ?>
        <li class="<?php echo $class; ?>"><a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl($key); ?>"
                                             title="<?php echo $lang; ?>"><img
                    src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/lang/<?php echo $key; ?>.png"
                    alt="<?php echo $lang; ?>"> <?php echo $lang; ?></a></li>
    <?php } ?>
</ul>
