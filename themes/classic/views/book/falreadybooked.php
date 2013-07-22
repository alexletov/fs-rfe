<?php
/**
 * @file falreadybooked.php
 * 
 * @autor Alex Letov
 * 
 * Flight already booked view.
 */
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">This <?php if(isset($ta) && ($ta == 1)) {?>turnaround <?php ;} ?>flight is already booked. You can see details <a href="<?php echo Yii::app()->createAbsoluteUrl('book/details', array('booking' => $bookid)); ?>" class="dotted-under">here</a></p>
    </div>
</div>