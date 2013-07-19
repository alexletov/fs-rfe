<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">This flight is already booked. You can see details <a href="<?php Yii::app()->createAbsoluteUrl('book/details', array('booking' => $bookid)); ?>" class="dotted-under">here</a></p>
    </div>
</div>