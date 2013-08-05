<?php
/**
 * @file rmnotfound.php
 * 
 * @autor Alex Letov
 * 
 * User reservation user acces denied view.
 */

$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?>
<div class="row-fluid">
    <div class="well">
        <p class="text-error">Database error. Your <?php if($type == 'book' ) {?>booking<?php } else { ?>slot reservation<?php }; ?> wasn't removed from database.</p>
    </div>
</div>