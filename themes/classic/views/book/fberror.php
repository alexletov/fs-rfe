<?php
/**
 * @file fberror.php
 * 
 * @autor Alex Letov
 * 
 * Flight booking error view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <?php if($errta == 1)
        {
        ?>
            <p class="text-success">Flight successfully booked.</p>
            <p class="text-error">Your turnaround flight wasn't booking due to error.</p>
        <?php
        }
        else
        {
        ?>
        <p class="text-error"><?php if($ta == 1) { ?>Something was going wrong. Flight and turnaround was NOT booked.<?php } else { ?>Something was going wrong. Flight was NOT booked.<?php }; ?></p>
        <?php
        };
        ?>
    </div>
</div>