<?php
/**
 * @file rdsuccess.php
 * 
 * @autor Alex Letov
 * 
 * Slot reservation delete success admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-success">Slot reservation id <?php echo $id; ?> removed successfully.<br />Your admin details logged!</p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>