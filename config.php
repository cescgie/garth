<?php

//set timezone
date_default_timezone_set('Europe/Berlin');

//site address
define('DIR','http://astrid-garth.127.0.0.1.xip.io/');
define('DOCROOT', dirname(__FILE__));

// Credentials for the local server
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','astrid');
define('DB_USER','root');
define('DB_PASS','');

//set prefix for sessions
define('SESSION_PREFIX','astrid-garth_');

//set kontakt email
define('KONTAKT_EMAIL','astrid.garth@gmx.de');

//optionall create a constant for the name of the site
define('SITETITLE','Astrid Garth');
