<?php
/**
 * @file mainmenu.php
 * 
 * @autor Alex Letov
 * 
 * Main menu.
 */

$cn = Yii::app()->controller->uniqueid;
?><ul class="nav navbar-nav">
    <li<?php if($cn == 'main') { ?> class="active" <?php }; ?>><?php echo CHtml::link('Home', '/'); ?></li>
    
    <li><?php echo CHtml::link('Pilots briefing', '#'); ?></li>
    
    <li <?php if($cn == 'flight') { ?>class="active" <?php }; ?>><?php echo CHtml::link('<i class="icon-plane text-success"></i>&nbsp; Book your flight', Yii::app()->createAbsoluteUrl('flight/events', array('id' => 1))); ?></li>
    
    <li><?php echo CHtml::link('ATC', '#'); ?></li>
    
    <li><?php echo CHtml::link('Other', '#'); ?></li>                         
    <?php if(!Yii::app()->user->isGuest)
    { ?>
    <li<?php if($cn == 'user') { ?> class="active" <?php }; ?>><?php echo CHtml::link('My reservations', Yii::app()->createAbsoluteUrl('user/myreserved')); ?></li>
    <?php } else
    {?>
    <li><?php echo CHtml::link('Login', Yii::app()->createAbsoluteUrl('main/login')); ?></li>
    <?php }; ?>
</ul>
