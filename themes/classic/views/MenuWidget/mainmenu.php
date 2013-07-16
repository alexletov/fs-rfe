<?php
/**
 * @file mainmenu.php
 * 
 * @autor Alex Letov
 * 
 * Main menu.
 */
?><ul class="nav ">
    <li class="active"><?php echo CHtml::link('Home', '/'); ?></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('Pilots briefing', '#'); ?></li>
    <li class="divider-vertical"></li>
    <li><a href="#"><i class="icon-plane text-success" style="vertical-align: inherit !important; font-size: 20px;" ></i>&nbsp; Book your flight</a></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('ATC', '#'); ?></li>
    <li class="divider-vertical"></li>
    <li><?php echo CHtml::link('Other', '#'); ?></li>                         
</ul>
