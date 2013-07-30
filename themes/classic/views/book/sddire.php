<?php
/**
 * @file sddire.php
 * 
 * @autor Alex Letov
 * 
 * Slot direction error booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Slot doesn't reserved. Filled airport ICAO must be differen from slot airport ICAO.</p>      
    </div>
</div>