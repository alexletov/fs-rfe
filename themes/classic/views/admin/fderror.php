<?php
/**
 * @file fderror.php
 * 
 * @autor Alex Letov
 * 
 * Flight delete success admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Flight id <?php echo $id; ?> wasn't deleted. <?php if($type == 'db') { ?>Database error.<?php ;};
            if($type == 'nf') { ?>Flight not found in database.<?php ;}; ?><br />Your admin details logged!</p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>