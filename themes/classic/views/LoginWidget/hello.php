<?php
/**
 * @file hello.php
 * 
 * @autor Alex Letov
 * 
 * Hello of LoginWidget.
 */
?><p style="font-size:18px;">Hi, <?php echo Yii::app()->user->firstname.' '.Yii::app()->user->lastname; ?>!</p>
<p style="font-size:18px;">If you want logout, click <a href="<?php echo Yii::app()->createAbsoluteUrl('main/logout'); ?>">here</a></p> 