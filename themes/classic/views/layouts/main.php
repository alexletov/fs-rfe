<?php
/**
 * @file main.php
 * 
 * @autor Alex Letov
 * 
 * Main layout file. Default RFE Moscow 2013 Theme.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme;
?><!DOCTYPE HTML>
<html>
<head>
    <title>Moscow RFE 2013 booking system</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo CHtml::cssFile('http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.min.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/css/bootstrap.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/font/css/whhg.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/css/reset.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/styles/main.css'); ?>
    <?php echo CHtml::cssFile('http://fonts.googleapis.com/css?family=Roboto:100&subset=latin,cyrillic-ext'); ?>    
    <?php echo CHtml::scriptFile('http://code.jquery.com/jquery.js'); ?>
    <?php echo CHtml::scriptFile('http://code.jquery.com/ui/1.10.3/jquery-ui.min.js'); ?>
    <?php echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/js/bootstrap.min.js'); ?>
</head>
<body>
    <div class="container main-part">
        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="pull-left">
                <h1 class="text-muted" >
                    <?php echo CHtml::image($image_url.'/images/logo.png'); ?>
                    Moscow RFE 2013
                </h1>
            </div></div>
           <div class="col-6 col-lg-4">
           <?php if(!Yii::app()->user->isGuest) { ?>
           <div class="login_form">
                <?php $this->widget('LoginWidget'); ?>
           </div>
           <?php }; ?>
           
           
           </div>
          </div>
            <div class="navbar center">
                <div class="navbar-inner pullcenter">
                    <?php $this->widget('MenuWidget', array('menu' => 'main')); ?>
                </div>
            </div>

            <?php echo $content; ?>
            
        <div class="well ">
            <div>
                <strong>&copy; 2013, <a href="http://ru.ivao.aero" target="_blank">IVAO Russian Division</a></strong><br>
                <a href="http://twitter.com/#!/IVAORU" target="_blank" class="icon-twitter icons-soc"></a>
                <a href="http://www.facebook.com/groups/365423953473360/" target="_blank" class="icon-facebook icons-soc"></a>
                <a href="http://vk.com/ivaorus" target="_blank" class="icon-vk icons-soc"></a>
            </div>
            <div>
            </div>
        </div>
    </div>
</body>
</html>