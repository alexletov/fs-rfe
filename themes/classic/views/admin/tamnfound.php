<?php
/**
 * @file tamnfound.php
 * 
 * @autor Alex Letov
 * 
 * Turnaround record not found admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Turnaround record is not found on database.<br />Your admin details logged!</p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>