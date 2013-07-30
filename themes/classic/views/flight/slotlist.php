<?php
/**
 * @file list.php
 * 
 * @autor Alex Letov
 * 
 * Flight list view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <?php
        if($airport != null)
            {
                echo '<h1>Slot list: '.$airport->name.' ('.$airport->icao.')</h1>';
            }; ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Slot time</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($slots as $value)
            {
                $booked = $value->getBooking();
                echo '<tr class="';
                if($booked === null)
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
                echo '"><td>'.$value->time.'</td><td>';
                if($booked === null)
                {
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/slotreserve', array('slotid' => $value->id)).'" class="btn btn-success">Reserve</a>';
                }
                else
                {
                    $usr = $booked->getRelated('user');
                    if($usr != null)
                    {
                        $name = $usr->vid;
                    }
                    else
                    {
                        $name = 'Booked details';
                    };
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/slotdetail', array('reserveid' => $booked->id)).'" class="btn btn-danger">'.$name.'</a>';
                };
                echo '</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>