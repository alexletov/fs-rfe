<?php
/**
 * @file fbsuccess.php
 * 
 * @autor Alex Letov
 * 
 * Flight booking success view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <p class="text-success"><?php if($ta == 1) { ?>Flight and turnaround successfully booked.<?php } else { ?>Flight successfully booked.<?php }; ?></p>
    </div>
</div>