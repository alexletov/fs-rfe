<?php
/**
 * @file sdetails.php
 * 
 * @autor Alex Letov
 * 
 * Slot details booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <table class="table">
            <tr>
                <td>Airport</td>
                <td><?php if($airport) { echo $airport->icao.' ('.$airport->name.')'; }; ?></td>
            </tr>
            <tr>
                <td>Slot time</td>
                <td><?php echo $slot->time; ?></td>
            </tr>
            <tr>
                <td><?php if($slotr->arrival) { echo 'From'; } else { echo 'To'; }; ?></td>
                <td><?php echo $slotr->airport; ?></td>
            </tr>
            <tr>
                <td>Captain</td>
                <td><?php echo $user->firstname.' '.$user->lastname; ?></td>
            </tr>
            <tr>
                <td>VID</td>
                <td><?php echo $user->vid; ?></td>
            </tr>
            <tr>
                <td>Rating</td>
                <td><?php echo '<img src="http://ivao.aero/data/images/ratings/pilot/'.$user->ratingpilot.'.gif"'; ?></td>
            </tr>
        </table>
    </div>
</div>