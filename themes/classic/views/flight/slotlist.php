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
?><?php if($isadmin)
{ ?>
<script type="text/javascript">
    function deleteSlot(id)
    {
        if(confirm("Are you sure to delete flight? Note: all your actions will be logged!"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admin/removeslot'); ?>/id/"+id;
        }
    };
    
    function deleteReservation(id)
    {
        if(confirm("Are you sure to delete booking? Note: all your actions will be logged!"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admin/removereserve'); ?>/id/"+id;
        }
    };
</script>
<?php }; ?>
<div class="row-fluid">
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
                    <?php if($isadmin) { ?>
                    <th>Admin</th>    
                    <?php }; ?>
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
                echo '</td>';
                if($isadmin)
                {
                    echo '<td>';
                    echo '<a data-toggle="tooltip" title="Delete slot" href="javascript:deleteSlot('.$value->id.');"><i class="icon-remove text-error"></i></a>&nbsp;';
                    if($booked != null)
                    {
                        echo '<a data-toggle="tooltip" title="Delete reservation" href="javascript:deleteReservation('.$booked->id.');"><i class="icon-minus-sign text-warning"></i></a>';
                    }
                    echo '</td>';
                }
                echo '</tr>';
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
            $("#time").timepicker({                
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
        <form action="<?php echo Yii::app()->createAbsoluteUrl('admin/addslot', array('apt' => $airport->id)); ?>" method="post" class="form-inline">
            <fieldset>
                <input type="text" name="time" id="time" maxlength="8" placeholder="Slot time" />
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