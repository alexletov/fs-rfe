<?php
/**
 * @file fnfound.php
 * 
 * @autor Alex Letov
 * 
 * Flight not found admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">This flight is not found on database.<br />Your admin details logged!</p>
    </div>
</div>