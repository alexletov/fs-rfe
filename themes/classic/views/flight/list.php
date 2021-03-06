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
    $(function () {
        $("a[data-toggle='tooltip']").tooltip();
    });
    
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
    <?php if($isadmin)
    {
    ?>
    function deleteFlight(id)
    {
        if(confirm("Are you sure to delete flight? Note: all your actions will be logged!"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admin/removeflight'); ?>/id/"+id;
        }
    };
    
    function deleteBooking(id)
    {
        if(confirm("Are you sure to delete booking? Note: all your actions will be logged!"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admin/removebook'); ?>/id/"+id;
        }
    };
    
    
    function unlinkTurnaround(id1, id2)
    {
        if(confirm("Are you sure to unlink flights? Note: all your actions will be logged!"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admin/unlinkta'); ?>/id1/" + id1 + '/id2/' + id2;
        }
    };
    <?php
    };
    ?>    
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
                
                if($dir)
                {
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('flight/departures', array('id' => $airport->id)).'" class="dotted-under">View Departures <i class="icon-forward"></i></a>';
                }
                else
                {
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('flight/arrivals', array('id' => $airport->id)).'" class="dotted-under">View Arrivals <i class="icon-forward"></i></a>';
                }
            }; ?>
        
        <form action="#" method="post" class="form-inline pull-right">
            <fieldset>
                <input class="input-sm" type="text" name="ac" id="ac" maxlength="3" size="3" placeholder="Airline" <?php if(isset($conditions['ac'])) { echo 'value="'.$conditions['ac'].'"'; }; ?> />
                <input class="input-sm" type="text" name="nr" id="nr" maxlength="5" size="12" placeholder="Flight number" <?php if(isset($conditions['nr'])) { echo 'value="'.$conditions['nr'].'"'; }; ?> />
                <input class="input-sm" type="text" name="acft" id="acft" maxlength="4" size="4" placeholder="Aircraft" <?php if(isset($conditions['acft'])) { echo 'value="'.$conditions['acft'].'"'; }; ?> />
                <?php if($dir) { ?><input class="form-contol input-sm" type="text" name="from" id="from" maxlength="4" size="8" placeholder="From ICAO" <?php if(isset($conditions['from'])) { echo 'value="'.$conditions['from'].'"'; }; ?> /><?php } else { ?>
                <input class="input-sm" type="text" name="to" id="to" maxlength="4" size="8" placeholder="To ICAO" <?php if(isset($conditions['to'])) { echo 'value="'.$conditions['to'].'"'; }; ?> /> <?php };?>
                <input type="submit" value="Apply filter" class="btn btn-primary btn-sm" />       
             
            </fieldset>
        </form>
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
                $booking = $value->getBooking();
                if($booking === null)
                {
                    echo 'success';
                }
                else
                {
                   echo 'danger';
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
                <td><?php 
                    if($booking != null) 
                    {
                        $usr = $booking->getRelated('user');
                        if($usr != null)
                        {
                            $name = $usr->vid;
                        }
                        else
                        {
                            $name = 'Booked details';
                        }
                        echo '<a href="'.Yii::app()->createAbsoluteUrl('book/details', array('booking' => $booking->id)).'" class="btn btn-danger">'.$name.'</a>';
                    }
                    else
                    {
                        echo '<a href="'.Yii::app()->createAbsoluteUrl('book/book', array('flight' => $value->id)).'" class="btn btn-success">Book</a>';
                    }
                ?></td>
                <td>
                <?php
                    $ta = $value->getTurnaround();
                    if($ta != null)
                    {
                        echo '<span class="dotted-under" id="'.$ta->id.$ta->airline.$ta->flightnumber.'btn" 
                            onclick="showTurnaround(\'#'.$ta->id.$ta->airline.$ta->flightnumber.'\');">Show</span>';
                    }
                    else
                    {
                        echo '<div>Not available</div>';
                    }
                ?>
                </td>
                <?php
                    if($isadmin)
                    {
                ?>
                    <td><a data-toggle="tooltip" title="Delete flight" href="javascript:deleteFlight(<?php echo $value->id; ?>);"><i class="icon-remove text-error"></i></a>&nbsp;<?php if($booking != null) { ?><a data-toggle="tooltip" title="Delete booking" href="javascript:deleteBooking(<?php echo $booking->id; ?>);"><i class="icon-minus-sign text-warning"></i></a><?php ;}; ?></td>
                <?php
                    };
                ?>                
            </tr>
                <?php
                    if($ta != null)
                    {
                ?>
                        <tr class="<?php
                        $tabooking = $ta->getBooking();
                        if($tabooking === null)
                        {
                            echo 'success';
                        }
                        else
                        {
                           echo 'danger';
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
                            <td><?php 
                                if($tabooking != null) 
                                {
                                    $usr = $tabooking->getRelated('user');
                                    if($usr != null)
                                    {
                                        $name = $usr->vid;
                                    }
                                    else
                                    {
                                        $name = 'Booked details';
                                    }
                                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/details', array('booking' => $tabooking->id)).'" class="btn btn-danger">'.$name.'</a>';
                                }
                                else
                                {
                                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/book', array('flight' => $ta->id)).'" class="btn btn-success">Book</a>';
                                }
                            ?></td>
                            <td>
                                
                            <?php                     
                            if($isadmin)
                            {
                                echo '<a data-toggle="tooltip" title="Unlink turnaround" href="javascript:unlinkTurnaround( '.$value->id.', '.$ta->id.');"><i class="icon-resize-full text-error tooltip-link"></i></a>&nbsp;';
                                echo '<a data-toggle="tooltip" title="Delete flight" href="javascript:deleteFlight('.$ta->id.');"><i class="icon-remove text-error"></i></a>';
                                if($tabooking != null)
                                {
                                    echo '&nbsp;<a data-toggle="tooltip" title="Delete booking" href="javascript:deleteBooking('.$tabooking->id.');"><i class="icon-minus-sign text-warning"></i></a>';
                                }
                                if($dir == 1)
                                {
                                    echo '&nbsp;<a data-toggle="tooltip" title="Go to flight" href="';
                                    echo Yii::app()->createAbsoluteUrl('flight/departures', array('id' => $ta->airportid)).'#flt'.$ta->id;

                                }
                                else
                                {
                                    echo '&nbsp;<a data-toggle="tooltip" title="Go to flight" href="';
                                    echo Yii::app()->createAbsoluteUrl('flight/arrivals', array('id' => $ta->airportid)).'#flt'.$ta->id;
                                }
                                echo '"><i class="icon-arrow-right text-success"></i></a>';
                            }
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
        
        <?php
        if($isadmin)
        {
        ?>
        <?php echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/js/jquery.ui.timepicker.js'); ?>
        <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/styles/jquery.ui.timepicker.css'); ?>
        <script type="text/javascript">
        $(function() {
            $("#dtime, #atime").timepicker({                
                hours: {
                    starts: 0,                
                    ends: 23                  
                },
                minutes: {
                    starts: 0,                
                    ends: 55,                 
                    interval: 5               
                },
            });
        });
        </script>
        <form action="<?php echo Yii::app()->createAbsoluteUrl('admin/addflight', array('apt' => $airport->id, 'arrival' => $dir)); ?>" method="post" class="form-inline">
            <fieldset>
                <input class="input-mini" type="text" name="company" id="company" maxlength="3" placeholder="Airline" />
                <input class="input-small" type="text" name="flightnumber" id="flightnumber" maxlength="5" placeholder="Flight number" />
                <input class="input-mini" type="text" name="aircraft" id="aircraft" maxlength="4" placeholder="Aircraft" />
                <input class="input-mini" type="text" name="gate" id="gate" maxlength="4" placeholder="Gate" />
                <input class="input-mini" type="text" name="from" id="from" maxlength="4" placeholder="Dep ICAO" />
                <input class="input-mini" type="text" name="to" id="to" maxlength="4" placeholder="Arr ICAO" />
                <input class="input-small" type="text" name="dtime" id="dtime" maxlength="8" placeholder="Dep time" />
                <input class="input-small" type="text" name="atime" id="atime" maxlength="8" placeholder="Arr time" />
                <button type="submit" class="btn btn-success">
                    <i class="icon-ok"></i>&nbsp;Add
                </button>
            </fieldset>
        </form>
        <?php
        };
        ?>
    </div>
</div>