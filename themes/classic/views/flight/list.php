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
?><div class="row-fluid">
    <div class="well">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Flight</th>
                    <th>Aircraft</th>
                    <th>Gate</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Info</th>
                    <th>Turnaround</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($flights != null)
                {
                    foreach($flights as $key => $value)
                    {
                        if($dir != $value->arrival)
                        {
                            continue;
                        }
            ?>
            <tr>
                <td>
                    <a name="<?php echo 'flt'.$value->id; ?>"></a>
                    <img src="<?php echo $image_url.'/airlines/'.$value->airline.'.gif'; ?>" />
                </td>
                <td><?php echo $value->airline.$value->flightnumber; ?></td>
                <td><?php echo $value->aircraft; ?></td>
                <td><?php echo $value->gate; ?></td>
                <td><?php echo $value->fromicao; ?></td>
                <td><?php echo $value->toicao; ?></td>
                <td><?php echo $value->fromtime; ?></td>
                <td><?php echo $value->totime; ?></td>
                <td>Info</td>
                <td>
                <?php
                    $ta = $value->getTurnaround();
                    if($ta != null)
                    {
                        $booked = $ta->getBooking();
                        if($dir == 1)
                        {
                            echo '<a href="';
                            echo Yii::app()->createAbsoluteUrl('flight/departures', array('id' => $ta->airportid)).'#flt'.$ta->id;
                            
                        }
                        else
                        {
                            echo '<a href="';
                            echo Yii::app()->createAbsoluteUrl('flight/arrivals', array('id' => $ta->airportid)).'#flt'.$ta->id;
                        }
                        
                        echo '" ';
                        if($booked === null)
                        {
                            echo 'class="btn btn-info"';
                        }
                        else
                        {
                            echo 'class="btn btn-inverse"';
                        }
                        echo '>'.$ta->airline.$ta->flightnumber.'</a>';
                    }
                ?>
                </td>
                <td>Admin</td>
            </tr>
            <?php
                    };
                }
            ?>
            </tbody>
        </table>
    </div>
</div>