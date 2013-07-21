<?php
/**
 * @file fanodata.php
 * 
 * @autor Alex Letov
 * 
 * Flight add no required data recieved admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Flight wasn't added to database. No reuqired data recieved!<br />Your admin details logged!</p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>