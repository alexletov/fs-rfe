<?php
/**
 * @file main.php
 * 
 * @autor Alex Letov
 * 
 * Main configuration file.
 */
return array(
    'name' => 'Test',
    'defaultController' => 'main',
    'theme' => 'classic',
    'preload' => array (
        'log'
    ),
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
        'urlManager' => array (
            'urlFormat' => 'path',
            'showScriptName'=>false,
            'caseSensitive'=>false,
        ),
        'log' => array (
            'class'  => 'system.logging.CLogRouter',
            'routes' => array (
                array (
                    'class'  => 'CWebLogRoute',
                    'levels' => 'error, warning, trace, info',
                ),
            ),
        ),
        'session' => array(
            'autoStart'=>true,
        ),
    ),
);
?>
