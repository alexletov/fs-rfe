<?php
/**
 * @file rmnotfound.php
 * 
 * @autor Alex Letov
 * 
 * User reservation success view.
 */

$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?>
<div class="row-fluid">
    <div class="well">
        <p class="text-success">Your <?php if($type == 'book' ) {?>booking<?php } else { ?>slot reservation<?php }; ?> successfully removed from database.</p>
    </div>
</div>