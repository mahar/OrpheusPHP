<?php
/**
 * OrpheusPHP Framework
 * 
 * @version 0.1
 * @author Charalampos Mavidis
 * @Copyright (c) 2015-2016, Charalampos Mavidis 
 * 
 * 
 *    
 */ 

// 

// If php version < 5.3 
if ( !defined('__DIR__') ) define('__DIR__', dirname(__FILE__));

if(phpversion() < 5) {exit('PHP VERSION 5 OR GREATER IS REQUIRED.');}

// display errors in development mode
ini_set('display_errors',1);
error_reporting(E_ALL);

/* DEFINE SOME CONSTANTS */
const APP_NAME        = "Orpheus";
const VERSION_NUMBER  = 0.1;
const VERSION_STRING  = 'alpha';

// The applications root path, so we can easily get this path from files located in other 
define('APP_PATH',__DIR__);

// URL 
const BASE_URL = 'http://mavidis.xyz/OrpheusFramework/OrpheusFramework';

// True if scripts outside of the framework are allowed. Default: FALSE
const ALLOW_OUTSIDE_SCRIPTS = false;

// Set the include path
$paths = array(
    APP_PATH, 
    APP_PATH . "/core/",
    APP_PATH . "/core/libraries/",
    APP_PATH . "/controllers/",
    APP_PATH . "/models/",
    get_include_path()
);
//set_include_path(implode(PATH_SEPARATOR, $paths));
echo APP_PATH; echo "<br />";

// Include core files
require_once(APP_PATH . '/core/load.php');
require_once(APP_PATH . '/core/App.php');
require_once(APP_PATH .'/core/registry.php');
require_once(APP_PATH .'/core/orpheus_model.php');
require_once(APP_PATH .'/core/Orpheus_Controller.php');

$app = new App(APP_PATH);






