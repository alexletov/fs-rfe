<?php
/**
 * @file index.php
 * 
 * @autor Alex Letov
 * 
 * Yii enter file.
 */
#defined('YII_DEBUG') or define('YII_DEBUG', true);

#error_reporting(E_ALL);

require_once('framework/yii.php');

$config='protected/config/main.php';

Yii::createWebApplication($config)->run();

?>
