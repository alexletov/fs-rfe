<?php
/**
 * @file partners.php
 * 
 * @autor Alex Letov
 * 
 * Partners view.
 */
?><div class="row-fluid">
    <div class="well">
        <ul class="nav nav-tabs" id="partnersTab" data-tabs="tabs">
            <li<?php if(strtolower($apt) == 'ulli') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ulli')); ?>">ULLI</a></li>
            <li<?php if(strtolower($apt) == 'uwgg') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'uwgg')); ?>">UWGG</a></li>
            <li<?php if(strtolower($apt) == 'ltai') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ltai')); ?>">LTAI</a></li>
            <li<?php if(strtolower($apt) == 'ltba') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ltba')); ?>">LTBA</a></li>
        </ul>
        <div class="tab-content">
        <?php
        switch(strtolower($apt))
        {
            case 'ulli': $this->renderPartial('partners/ulli'); break;
            case 'uwgg': $this->renderPartial('partners/uwgg'); break;
            case 'ltai': $this->renderPartial('partners/ltai'); break;
            case 'ltba': $this->renderPartial('partners/ltba'); break;
            default: $this->renderPartial('partners/ulli'); break;
        };
        ?>
        </div>

<script type="text/javascript">  
  jQuery(document).ready(function ($) {
        $('#partnersTab').tab();
    });
</script>
</div>
</div>
