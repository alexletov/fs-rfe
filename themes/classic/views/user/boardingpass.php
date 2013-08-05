<?php
/**
 * @file boardingpass.php
 * 
 * @autor Alex Letov
 * 
 * Boarding pass user view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <img src="<?php echo Yii::app()->createAbsoluteUrl('user/bpimg', array('booking' => $booking)); ?>" alt="Boarding Pass"/>
        <p>
            <a href="<?php echo Yii::app()->request->urlReferrer; ?>">Return to previous page</a>
        </p>
    </div>
</div>