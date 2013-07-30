<?php
/**
 * @file saerror.php
 * 
 * @autor Alex Letov
 * 
 * Slot add error admin view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <p class="text-error">Slot wasn't added to database.<br />Your admin details logged!</p>
        <p class="text-error">Error details from database and validator:<br />
            <?php
            if(is_array($error))
            {
                foreach($error as $err)
                {
                    foreach($err as $val)
                    {
                        echo $val.'<br />';
                    };
                };
            }
            else
            {
                echo $error;
            };
            ?>
        </p>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>