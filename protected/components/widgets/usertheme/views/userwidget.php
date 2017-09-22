<?php
if (isset(Yii::app()->modules['User']))
    $profile = Profile::model()->findByPk(Yii::app()->user->id);
else
    $profile = null;
?>
    <a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span
            class="hidden-phone text"><?php echo Yii::app()->user->name; ?></span><i></i></a>
    <ul class="dropdown-menu pull-right">
        <li><a href="<?php echo Yii::app()->createUrl('/User/profile/view', array('id' => Yii::app()->user->id)); ?>"
               class="glyphicons user">Profilul meu<i></i></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('/User/profile/edit', array('id' => Yii::app()->user->id)); ?>"
               class="glyphicons cogwheel">Editaţi profil<i></i></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('/User/password/change'); ?>" class="glyphicons keys">Schimbaţi
                parola<i></i></a></li>
        <!--li><a href="#" class="glyphicons camera">My Photos<i></i></a></li-->
        <?php if (!empty($profile)) { ?>
            <li class="highlight profile">
		<span>
			<!--span class="heading">Profil <a href="<?php echo Yii::app()->createUrl('/User/profile/edit', array('id' => Yii::app()->user->id)); ?>" class="pull-right">editeaza</a></span-->
			<span class="img"></span>
                            <span class="details">
                                    <!--a href="#">Mosaic Pro</a-->
                                    <p><b><?php echo $profile->firstname . ' ' . $profile->lastname; ?></b></p>
                                <!--p><a href="mailto:<?php echo $profile->email; ?>"><?php echo $profile->email; ?></a></p-->
                                    <small><?php echo Yii::t('mod_menu', 'about');
                                        echo " " . Yii::app()->user->name; ?></small>
                            </span>
			<span class="clearfix"></span>
		</span>
            </li>
        <?php } ?>
        <li>
		<span style="padding-right: 0">
			<!--a class="btn btn-default btn-small pull-right" style="padding: 2px 10px; background: #fff;" href="#">Sign Out</a-->
            <?php $this->widget('application.components.widgets.usertheme.UserButton', array(
                'label' => 'Ieşiţi din cont',
                'icon' => 'unshare',
                'type' => 'warning',
                'url' => Yii::app()->createUrl('site/logout'),
                'htmlOptions' => array('class' => 'pull-right'))); ?>
		</span>
        </li>
    </ul>
<?php /* $this->widget('application.components.widgets.usertheme.UserButton', array(
    'type' => 'primary',
    'size'=>'small',
    'label' => 'Primary Small Button', */