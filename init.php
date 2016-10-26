<?php

define('ENVIRONMENT', 'development');

    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;
        case 'production':
            error_reporting(0);
            break;
        default:
            break;
    }


		define("MYSQL_DATABASE_SERVER", "localhost");
		define("MYSQL_DATABASE_NAME", "mojedatabase");
		define("MYSQL_DATABASE_USER", "root");
		define("MYSQL_DATABASE_PASSWORD", "");


?>