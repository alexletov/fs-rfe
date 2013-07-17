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
?><html>
<head>
    <title>Moscow RFE 2013 booking system</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/css/bootstrap.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/font/css/whhg.css'); ?>
    <?php echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/css/reset.css'); ?>
    <?php echo CHtml::cssFile('http://fonts.googleapis.com/css?family=Roboto:100&subset=latin,cyrillic-ext'); ?>    
    <?php echo CHtml::scriptFile('http://code.jquery.com/jquery.js'); ?>
    <?php echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/bootstrap/js/bootstrap.min.js'); ?>
</head>
<body>
    <div class="container main-part">
        <div>
            <div style="text-align:center">
                <h1 class="muted" >
                    <?php echo CHtml::image($image_url.'/images/logo.png'); ?>
                    Moscow RFE 2013 booking system
                </h1>
            </div>
            <div class="navbar center">
                <div class="navbar-inner pullcenter">
                    <?php $this->widget('MenuWidget', array('menu' => 'main')); ?>
                </div>
            </div>

            <?php echo $content; ?>
        </div>      
        <div class="well ">
            <div>
                <strong>IVAO Russian division - 2013 </strong><br>
                <a href="http://twitter.com/#!/IVAORU"><i class="icon-twitter icons-soc"></i></a>
                <a href="http://www.facebook.com/groups/365423953473360/"><i class="icon-facebook icons-soc"></i></a>
                <a href="http://vk.com/ivaorus"><i class="icon-vk icons-soc"></i></a>
            </div>
            <div>
            </div>
        </div>
    </div>
</body>
</html>