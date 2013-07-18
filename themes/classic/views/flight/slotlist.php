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
                echo '<tr class="';
                if($value->getRelated('book') === null)
                {
                    echo 'success';
                }
                else
                {
                    echo 'error';
                }
                echo '"><td>'.$value->time.'</td><td>Info</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>