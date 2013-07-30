<?php
/**
 * @file sdberror.php
 * 
 * @autor Alex Letov
 * 
 * Slot database error booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Slot doesn't reserved. Please, try again later.</p>
    </div>
</div>