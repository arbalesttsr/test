<li class="dropdown">
    <a href="#" data-toggle="dropdown">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/lang/<?php echo $this->currentLang; ?>.png"
             alt="<?php echo $this->currentLang; ?>"/>

    </a>
    <ul class="dropdown-menu userinfo arrow">
        <li class="userlinks">
            <ul class="dropdown-menu module-menu">
                <?php foreach ($this->languages as $key => $lang) { ?>
                    <?php $class = ''; ?>
                    <?php if ($key == $this->currentLang) $class = 'active'; ?>
                    <li class="<?php echo $class; ?>">
                        <a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl($key); ?>"
                           title="<?php echo $lang; ?>">
                            <?php echo $lang; ?>
                            <img class="pull-right"
                                 src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/lang/<?php echo $key; ?>.png"
                                 alt="<?php echo $lang; ?>">
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li><!-- user links -->
    </ul>
</li>
