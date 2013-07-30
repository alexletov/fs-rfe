<?php
/**
 * @file srnfound.php
 * 
 * @autor Alex Letov
 * 
 * Slot reservation not found booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">This reservations is not found on database.</p>
    </div>
</div>