<?php
/**
 * @file sierror.php
 * 
 * @autor Alex Letov
 * 
 * Slot internal error booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Database internal error. Slot or user not found.</p>
    </div>
</div>