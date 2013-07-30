<?php
/**
 * @file salreadybooked.php
 * 
 * @autor Alex Letov
 * 
 * Slot already booked view.
 */
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">This slot is already booked. You can see details <a href="<?php echo Yii::app()->createAbsoluteUrl('book/slotdetail', array('reserveid' => $bookid)); ?>" class="dotted-under">here</a></p>
    </div>
</div>