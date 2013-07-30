<?php
/**
 * @file svalidateerror.php
 * 
 * @autor Alex Letov
 * 
 * Slot validation error booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Airport ICAO length must be 4.</p>
    </div>
</div>