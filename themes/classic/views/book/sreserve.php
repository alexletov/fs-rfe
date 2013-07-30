<?php
/**
 * @file sreserve.php
 * 
 * @autor Alex Letov
 * 
 * Slot reserve booking view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
$isadmin = UserModel::isAdmin(Yii::app()->user->getId());
?><div class="row-fluid">
    <div class="well">
        <h1>Slot reserve: <?php echo $slottime; ?></h1>
        <form action="<?php echo Yii::app()->createAbsoluteUrl('book/slotregister', array('slotid' => $slotid)); ?>" method="post" class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="arrival">Arrival?</label> 
                    <div class="controls">
                        <input type="checkbox" id="arrival" name="arrival">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="airport">Airport</label>
                    <div class="controls">
                        <input type="text" id="airport" name="airport" placeholder="ICAO">                        
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-ok"></i>&nbsp;Reserve
                        </button>
                    </div>
                </div>
                
            </fieldset>
        </form>
    </div>
</div>