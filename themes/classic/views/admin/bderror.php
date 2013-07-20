<?php
/**
 * @file bderror.php
 * 
 * @autor Alex Letov
 * 
 * Booking delete success admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Booking id <?php echo $id; ?> wasn't deleted. <?php if($type == 'db') { ?>Database error.<?php ;};
            if($type == 'nf') { ?>Booking not found in database.<?php ;}; ?><br />Your admin details logged!</p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>