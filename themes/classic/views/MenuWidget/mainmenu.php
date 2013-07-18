<?php
/**
 * @file mainmenu.php
 * 
 * @autor Alex Letov
 * 
 * Main menu.
 */

$cn = Yii::app()->controller->uniqueid;
?><ul class="nav ">
    <li <?php if($cn == 'main') { ?>class="active" <?php }; ?>><?php echo CHtml::link('Home', '/'); ?></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('Pilots briefing', '#'); ?></li>
    <li class="divider-vertical"></li>
    <li <?php if($cn == 'flight') { ?>class="active" <?php }; ?>><?php echo CHtml::link('<i class="icon-plane text-success" style="vertical-align: inherit !important; font-size: 20px;" ></i>&nbsp; Book your flight', Yii::app()->createAbsoluteUrl('flight/events')); ?></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('ATC', '#'); ?></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('Other', '#'); ?></li>                         
</ul>
