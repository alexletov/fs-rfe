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
  <table class="table">
      <tr><td style="width:10%"></td>
        <?php
          for($i = 0; $i < $count; $i++)
          {
              echo '<th><h1>'.$airports[$i]->name.' ('.$airports[$i]->icao.')</h1></th>';
          }
        ?></tr>
    <tr>
        <td style="width:10%"></td>
        <?php
            for($i = 0; $i < $count; $i++)
            {
            ?>
                <td><h3><i class="icon-downright" style="vertical-align: inherit !important; font-size: 22px;" ></i>&nbsp;<a class="booking" href="<?php echo Yii::app()->createAbsoluteUrl('flight/arrivals', array('id' => $airports[$i]->id)); ?>">Arrivals</a></h3></td>
            <?php
            };
        ?>      
    </tr>
    <tr>
        <td style="width:10%"></td>
        <?php
            for($i = 0; $i < $count; $i++)
            {
            ?>
                <td><h3><i class="icon-upright" style="vertical-align: inherit !important; font-size: 22px;" ></i>&nbsp;<a class="booking" href="<?php echo Yii::app()->createAbsoluteUrl('flight/departures', array('id' => $airports[$i]->id)); ?>">Departures</a></h3></td>
            <?php
            };
        ?>      
    </tr>
    <tr>
        <td style="width:10%"></td>
        <?php
            for($i = 0; $i < $count; $i++)
            {
            ?>
                <td><h3><i class="icon-resize-full" style="vertical-align: inherit !important; font-size: 22px;" ></i>&nbsp;<a class="booking" href="<?php echo Yii::app()->createAbsoluteUrl('flight/slots', array('id' => $airports[$i]->id)); ?>">Own flights</a></h3></td>
            <?php
            }
        ?>      
    </tr>
</table>
</div>
</div>