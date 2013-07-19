<?php
/**
 * @file prebook.php
 * 
 * @autor Alex Letov
 * 
 * Prebook view.
 */
?><div class="row-fluid">
    <div class="well">
        <table class="table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><h1>Flight to book</h1></th>
                    <th><h1>Turnaround flight</h1></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php if($ta == null) { ?>Not available<?php } else { ?>&nbsp;<?php }; ?></td>
                </tr>
                <tr>
                    <td>Flight number</td>
                    <td><?php echo $flight->airline.$flight->flightnumber; ?></td>
                    <td <?php if($ta == null) { ?>colspan="8"><?php } else { ?>><?php echo $ta->airline.$ta->flightnumber; }; ?></td>
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
                    <td><?php echo $flight->fromicao ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->fromicao.'</td>'; };?>
                </tr>
                <tr>
                    <td>To</td>
                    <td><?php echo $flight->toicao ?></td>
                    <?php if($ta != null) { echo '<td>'.$ta->toicao.'</td>'; };?>
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
                    <td><i class="text-success icon-ok"></i></td><?php if($ta != null) { ?>
                    <?php if($ta->getBooking() == null) { $avail = 1; } else { $avail = 0; };?>
                    <td><i class="<?php if($avail == 1) {?>text-success icon-ok<?php ;} else {?>text-error icon-remove<?php }; ?>"></i></td>
                    <?php }; ?>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><a href="<?php echo Yii::app()->createAbsoluteUrl('book/flightregister', array('flight'=> $flight->id)); ?>" class="btn btn-success">Book flight</a></td>
                    <?php if($ta != null) { ?>
                    <td>
                        <?php if($avail == 1) {?>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('book/flightregister', array('flight'=> $flight->id, 'ta' => 1)); ?>" class="btn btn-success">Book both (with turnaround flight)</a>
                        <?php ;} else {?>
                            <div class="btn btn-danger">Book both flights unavailable</div>
                        <?php }; ?>
                    </td>
                    <?php }; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>