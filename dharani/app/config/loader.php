<?php

$loader = new \Phalcon\Loader();
//print_r($config->application);
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        //'../services/',
        
        $config->application->modelsDir,
        $config->application->servicesDir
    ]
)->register();


