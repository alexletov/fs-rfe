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
?><style type=text/css>
    .hide {
        display: none;
    }
</style>
<script type="text/javascript">
    function showTurnaround(id) {
        if($(id).hasClass("hide"))
        {
            $(id).removeClass("hide");
        }
        else
        {
            $(id).toggle();
        };
        btnid = id + "btn";
        if($(btnid).text() == "Show")
        {
            $(btnid).text("Hide");
        }
        else
        {
            $(btnid).text("Show");
        };
    };
</script>

<div class="row-fluid">
    <div class="well">
        <?php
        if($airport != null)
            {
                if($dir)
                {
                    echo '<h1>Arrivals: ';
                }
                else
                {
                    echo '<h1>Departures: ';
                }
                echo $airport->name.' ('.$airport->icao.')</h1>';
            }; ?>
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
                    <?php
                        if($isadmin)
                        {
                    ?>
                    <th>Admin</th>
                    <?php
                        };
                    ?>
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
            <tr class="<?php
                if($value->getBooking() === null)
                {
                    echo 'success';
                }
                else
                {
                   echo 'error';
                };
            ?>">
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
                        echo '<a href="#" class="dotted-under" id="'.$ta->id.$ta->airline.$ta->flightnumber.'btn" 
                            onclick="showTurnaround(\'#'.$ta->id.$ta->airline.$ta->flightnumber.'\');">Show</a>';
                    }
                    else
                    {
                        echo '<div>Not avlbl</div>';
                    }
                ?>
                </td>
                <?php
                    if($isadmin)
                    {
                ?>
                    <td><a href="#"><i class="icon-remove text-error"></i></a>&nbsp;<a href="#"><i class="icon-minus-sign text-warning"></i></a></td>
                <?php
                    };
                ?>                
            </tr>
                <?php
                    if($ta != null)
                    {
                ?>
                        <tr class="<?php
                        if($ta->getBooking() === null)
                        {
                            echo 'success';
                        }
                        else
                        {
                           echo 'error';
                        };
                        ?> hide" id="<?php echo $ta->id.$ta->airline.$ta->flightnumber; ?>">
                        <td colspan="10">
                            <table class="pull-right">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Flight</th>
                                    <th>Aircraft</th>
                                    <th>Gate</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Info</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                            <td>
                                <a name="<?php echo 'taflt'.$ta->id; ?>"></a>
                                <img src="<?php echo $image_url.'/airlines/'.$ta->airline.'.gif'; ?>" />
                            </td>
                            <td><?php echo $ta->airline.$ta->flightnumber; ?></td>
                            <td><?php echo $ta->aircraft; ?></td>
                            <td><?php echo $ta->gate; ?></td>
                            <td><?php echo $ta->fromicao; ?></td>
                            <td><?php echo $ta->toicao; ?></td>
                            <td><?php echo $ta->fromtime; ?></td>
                            <td><?php echo $ta->totime; ?></td>
                            <td>Info</td>
                            <td>
                            <?php
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
                            echo '>GO TO</a>';
                            ?>
                            </td>
                            
                        </tr>  
                        </tbody>
                        
                        </table>
                        </td>
                        <?php
                    if($isadmin)
                    {
                ?>
                    <td>&nbsp;</td>
                <?php
                    };
                ?> 
                        </tr>
                        <?php
                        }
                    };
                }
            ?>
            </tbody>
        </table>
    </div>
</div>