<?php
/*
 * 
 * All the configurations for the project go here
 */
 

/** Development Environment **/
// when Set to false, no error will be throw out, but saved in temp/log.txt file.
define ('DEVELOPMENT_ENVIRONMENT',true);

define('DB_HOST', 'localhost');
//define('DB_NAME', 'smartojr_mcqforum');
//define('DB_USER','smartojr_joker');
//define('DB_PASSWORD','joker');
define('DB_NAME', 'mcqforum');
define('DB_USER','root');
define('DB_PASSWORD','theanimalfarm');



/** Site Root **/
// Domain name of the site (no slash at the end!)
//define('SITE_ROOT' , 'http://You domain name');
//define('SITE_ROOT' , 'http://localhost');

// Default controller and action on landing
define ('DEFAULT_CONTROLLER', "Index");
define ('DEFAULT_ACTION', "index");

// No of questions per page
define('QUESTIONS_PER_PAGE',5);

