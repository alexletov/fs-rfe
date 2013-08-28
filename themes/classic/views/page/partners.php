<?php
/**
 * @file partners.php
 * 
 * @autor Alex Letov
 * 
 * Partners view.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/images';
?><div class="row-fluid">
    <div class="well">
        <ul class="nav nav-tabs" id="partnersTab" data-tabs="tabs">
            <li<?php if(strtolower($apt) == 'ulli') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ulli')); ?>"><img src="<?php echo $image_url; ?>/flags/ru.png" />&nbsp;ULLI</a></li>
            <li<?php if(strtolower($apt) == 'uwgg') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'uwgg')); ?>"><img src="<?php echo $image_url; ?>/flags/ru.png" />&nbsp;UWGG</a></li>
            <li<?php if(strtolower($apt) == 'uwww') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'uwww')); ?>"><img src="<?php echo $image_url; ?>/flags/ru.png" />&nbsp;UWWW</a></li>
            <li<?php if(strtolower($apt) == 'ltai') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ltai')); ?>"><img src="<?php echo $image_url; ?>/flags/tr.png" />&nbsp;LTAI</a></li>
            <li<?php if(strtolower($apt) == 'ltba') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'ltba')); ?>"><img src="<?php echo $image_url; ?>/flags/tr.png" />&nbsp;LTBA</a></li>
            <li<?php if(strtolower($apt) == 'umms') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'umms')); ?>"><img src="<?php echo $image_url; ?>/flags/by.png" />&nbsp;UMMS</a></li>
            <li<?php if(strtolower($apt) == 'lipz') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'lipz')); ?>"><img src="<?php echo $image_url; ?>/flags/it.png" />&nbsp;LIPZ</a></li>
            <li<?php if(strtolower($apt) == 'lkpr') { ?> class="active"<?php }; ?>><a href="<?php echo Yii::app()->createAbsoluteUrl('page/partners', array('apt' => 'lkpr')); ?>"><img src="<?php echo $image_url; ?>/flags/cz.png" />&nbsp;LKPR</a></li>
        </ul>
        <div class="tab-content">
        <?php
        switch(strtolower($apt))
        {
            case 'ulli': $this->renderPartial('partners/ulli'); break;
            case 'uwgg': $this->renderPartial('partners/uwgg'); break;
            case 'ltai': $this->renderPartial('partners/ltai'); break;
            case 'ltba': $this->renderPartial('partners/ltba'); break;
            case 'uwww': $this->renderPartial('partners/uwww'); break;
            case 'umms': $this->renderPartial('partners/umms'); break;
            case 'lipz': $this->renderPartial('partners/lipz'); break;
            case 'lkpr': $this->renderPartial('partners/lkpr'); break;
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
