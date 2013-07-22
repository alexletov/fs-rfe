<?php
/**
 * @file bdetails.php
 * 
 * @autor Alex Letov
 * 
 * Booking details view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <table class="table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><h1>Flight booking details</h1></th>
                    <th><h1>Turnaround flight</h1></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php if($ta == null) { ?><div class="text-error"><i class="icon-lock"></i> Not available</div><?php } else { ?>&nbsp;<?php }; ?></td>
                </tr>
                <tr>
                    <td>Flight number</td>
                    <td><img src="<?php echo $image_url.'/airlines/'.$flight->airline.'.gif'; ?>" />&nbsp;<?php echo $flight->airline.$flight->flightnumber; ?></td>
                    <td <?php if($ta == null) { ?>colspan="8"><?php } else { ?>><?php echo '<img src="'.$image_url.'/airlines/'.$ta->airline.'.gif" />&nbsp;'.$ta->airline.$ta->flightnumber; }; ?></td>
                </tr>
                
                <tr>
                    <td>Aircraft</td>
                    <td><?php echo $flight->aircraft ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->aircraft.'</td>'; };?>
                </tr>
                <tr>
                    <td>Gate</td>
                    <td><?php echo $flight->gate ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->gate.'</td>'; };?>
                </tr>
                <tr>
                    <td>From</td>
                    <td><?php echo $flight->fromicao;
                    $fromap = AirportdbModel::getByICAO($flight->fromicao);
                    if($fromap != null)
                    {
                        echo ' ('.$fromap->name.', '.$fromap->city.', '.$fromap->country.'&nbsp;<img src="'.$image_url.'/flags/'.strtolower($fromap->country_iso).'.png" />)';
                    }
                    ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->fromicao;
                    $fromap = AirportdbModel::getByICAO($ta->fromicao);
                    if($fromap != null)
                    {
                        echo ' ('.$fromap->name.', '.$fromap->city.', '.$fromap->country.'&nbsp;<img src="'.$image_url.'/flags/'.strtolower($fromap->country_iso).'.png" />)';
                    }
                    echo '</td>'; };?>
                </tr>
                <tr>
                    <td>To</td>
                    <td><?php echo $flight->toicao;
                    $toap = AirportdbModel::getByICAO($flight->toicao);
                    if($toap != null)
                    {
                        echo ' ('.$toap->name.', '.$toap->city.', '.$toap->country.'&nbsp;<img src="'.$image_url.'/flags/'.strtolower($toap->country_iso).'.png" />)';
                    }        
                    ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->toicao;
                    $toap = AirportdbModel::getByICAO($ta->toicao);
                    if($toap != null)
                    {
                        echo ' ('.$toap->name.', '.$toap->city.', '.$toap->country.'&nbsp;<img src="'.$image_url.'/flags/'.strtolower($toap->country_iso).'.png" />)';
                    }       
                    echo '</td>'; };?>
                </tr>
                <tr>
                    <td>Departure time</td>
                    <td><?php echo $flight->fromtime ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->fromtime.'</td>'; };?>
                </tr>
                <tr>
                    <td>Arrival time</td>
                    <td><?php echo $flight->totime ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->totime.'</td>'; };?>
                </tr>
                <tr>
                    <td>Available</td>
                    <td><i class="text-error icon-remove"></i></td><?php if($ta != null) { ?>
                    <?php $bd = $ta->getBooking(); if($bd == null) { $avail = 1; } else { $avail = 0; };?>
                    <td><i class="<?php if($avail == 1) {?>text-success icon-ok<?php ;} else {?>text-error icon-remove<?php }; ?>"></i></td>
                    <?php }; ?>
                </tr>
                <tr>
                    <td>Captain</td>
                    <td><?php if(!($user === null))
                    {
                        echo $user->firstname.' '.$user->lastname;
                    };
                    ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>VID</td>
                    <td><?php if(!($user === null))
                    {
                        echo $user->vid;
                    };
                    ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Pilot rating</td>
                    <td><?php if(!($user === null))
                    {
                        echo '<img src="http://ivao.aero/data/images/ratings/pilot/'.$user->ratingpilot.'.gif"';
                    };
                    ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <?php if($ta != null) { ?>
                    <td>
                        <?php if($avail == 1) {?>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('book/flightregister', array('flight'=> $ta->id)); ?>" class="btn btn-success">Book turnaround</a>
                        <?php ;} else {?>
                            <a class="btn btn-danger" href="<?php echo Yii::app()->createAbsoluteUrl('book/details', array('booking'=> $bd->id)); ?>" class="btn btn-success">Details</a>
                        <?php }; ?>
                    </td>
                    <?php }; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>