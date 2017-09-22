<?php

$errors = false;
?>

<?php if (PHP_VERSION_ID < 50300): ?>
    <h3>
        Pentru instalare este nevoie de PHP 5.3<br/>
        La moment este instalata versiunea: <?php echo phpversion(); ?>
    </h3>
<?php else: ?>

    <div class="progress">
        <span class="active">1</span>→2→3
    </div>

    <h1><?php echo Yii::t('InstallModule.menu', 'Pasul 1. Verificare.') ?></h1>

    <div class="line"></div>

    <div class="form">
        <div class="m20">
            <?php echo Yii::t('InstallModule.menu', 'Urmatoarele directorii si fisiere trebuie sa posede dreptul de modificare.'); ?>
        </div>
        <table class="stripy" cellpadding="3" cellspacing="3">
            <?php foreach ($this->writeAble as $path): ?>
                <tr>
                    <td width="300px"><?php echo $path ?></td>
                    <td>
                        <?php
                        $result = $this->isWritable($path);
                        if ($result)
                            echo '<span class="green">OK</span>';
                        else {
                            $errors = true;
                            echo '<span class="red">NO</span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>

        <div class="row buttons">
            <?php if (!$errors): ?>
                <form action="" method="post">
                    <input type="hidden" name="ok" value="1">
                    <input type="submit" value="<?php echo Yii::t('InstallModule.menu', 'Continuare'); ?>">
                </form>
            <?php else: ?>
                <div class="m20">
                    <?php echo Yii::t('InstallModule.menu', 'Corectati erorile si tastati <a href="' . Yii::app()->baseUrl . '/install.php">Actualizare</a>'); ?>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif; ?>