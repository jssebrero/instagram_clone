<?php

date_default_timezone_set('America/Mexico_City');

error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment

ini_set('log_errors', TRUE); // Error/Exception file logging engine.

ini_set("error_log", "/xampp_PHP_8.2.4/htdocs/instagram/php-error.log");
//error_log( "Hello, errors!" );

require 'vendor/autoload.php';
require 'src/lib/routes.php';