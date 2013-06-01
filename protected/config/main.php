<?php
/**
 * @file main.php
 * 
 * @autor Alex Letov
 * 
 * Main configuration file.
 */
return array(
    'defaultController' => 'main',
    'theme' => 'custom',
    
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    
    'components' => array(
        'db' => array(
            'connectionString' => 'mysqli:host=127.0.0.1;dbname=fs-rfe',
            'tablePrefix' => '',
            'emulatePrepare' => 'true',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),
);
?>
