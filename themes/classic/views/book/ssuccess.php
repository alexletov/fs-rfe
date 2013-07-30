<?php
/**
 * @file ssuccess.php
 * 
 * @autor Alex Letov
 * 
 * Slot reserve success view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-success">Slot successfully reserved.</p>
    </div>
</div>