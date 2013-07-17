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
            ?>
            <tr>
                <th><img src="<?php echo $image_url.'/airlines/'.$value->airline.'.gif'; ?>" /></th>
                <td><?php echo $value->airline.$value->	flightnumber; ?></td>
                <td><?php echo $value->aircraft; ?></td>
                <td><?php echo $value->gate; ?></td>
                <td><?php echo $value->fromicao; ?></td>
                <td><?php echo $value->toicao; ?></td>
                <td><?php echo $value->fromtime; ?></td>
                <td><?php echo $value->totime; ?></td>
                <td>Info</td>
                <td>Turnaround</td>
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