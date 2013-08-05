<?php
/**
 * @file list.php
 * 
 * @autor Alex Letov
 * 
 * User flight and reservation list view.
 */

$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><script type="text/javascript">
    function deleteBooking(id)
    {
        if(confirm("Are you sure to cancel booking?"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('user/deletebook'); ?>/id/"+id;
        }
    };
    
    function deleteReserve(id)
    {
        if(confirm("Are you sure to delete slot reservation?"))
        {
            document.location.href = "<?php echo Yii::app()->createAbsoluteUrl('user/deletereserve'); ?>/id/"+id;
        }
    };
</script>
<div class="row-fluid">
    <div class="well">
        <h1>Reservations for <?php echo Yii::app()->user->firstname.' '.Yii::app()->user->lastname; ?></h1>
        <h2>Flight booking</h2>
        <?php if(($flights === null) || empty($flights)) { ?>
            No flight booking found!
        <?php } else { ?>
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
                </tr>
            </thead>
            <tbody>
            <?php foreach($flights as $key => $value)
                    {
                $val = $value->getRelated('flight');
                if($val === null)
                {
                    continue;
                }            
            ?>
            <tr>
                <td>
                    <img src="<?php echo $image_url.'/airlines/'.$val->airline.'.gif'; ?>" />
                </td>
                <td><?php echo $val->airline.$val->flightnumber; ?></td>
                <td><?php echo $val->aircraft; ?></td>
                <td><?php echo $val->gate; ?></td>
                <td><?php echo $val->fromicao; ?></td>
                <td><?php echo $val->toicao; ?></td>
                <td><?php echo $val->fromtime; ?></td>
                <td><?php echo $val->totime; ?></td>
                <td>
                <?php
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/details', array('booking' => $value->id)).'" class="btn btn-success">Details</a>';
                    echo '&nbsp;<a href="'.Yii::app()->createAbsoluteUrl('user/bp', array('booking' => $value->id)).'" class="btn btn-warning">Boarding pass</a>';
                    echo '&nbsp;<a href="javascript:deleteBooking('.$value->id.');" class="btn btn-danger">Cancel</a>';
                ?>
                </td>
            </tr>
            <?php }; ?> 
            </tbody>
        </table>
        <?php }; ?>
        <h2>Slot reservation</h2>
        <?php if(($slots === null) || empty($slots)) { ?>
            No slot reservation found!
        <?php } else { ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Airport</th>
                    <th>Slot time</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($slots as $value)
            {
                $val = $value->getRelated('slot');
                if($val === null)
                {
                    continue;
                }
                $apt = $val->getRelated('airport');
            ?>
            <tr>
                <td><?php echo $apt != null ? $apt->icao : ''; ?></td>
                <td><?php echo $val->time; ?></td>
                <td>
                <?php
                    echo '<a href="'.Yii::app()->createAbsoluteUrl('book/slotdetail', array('reserveid' => $value->id)).'" class="btn btn-success">Details</a>';
                    echo '&nbsp;<a href="javascript:deleteReserve('.$value->id.');" class="btn btn-danger">Cancel</a>';
                ?>
                </td>
            </tr>                
            <?php    
            };
            ?>
            </tbody>
        </table>
        <?php }; ?>
    </div>
</div>