<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__))); 
define('SITE_TITLE', "UPSC IAS previous years question papers and practice papers"); 

$url = isset($_GET['url']) ? $_GET['url'] : null ;

require_once (ROOT . DS . 'config' . DS . 'config.php');

require_once( ROOT . DS . 'library' . DS . 'router.php');


