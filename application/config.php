<?php

/**
 * Configuration settings
 *
 * Note that the db connection constants may be defined here
 * but are actually pulled from _include/database_pass
 */

// debug mode
define('DEBUG_MODE', true);

// number of records to show per page
define('RECORDS_PER_PAGE', 20);

// database credentials
include_once('database_pass/privacyincidents.inc.php');
define('DB_USER', $user);
define('DB_PASS', $pass);
define('DB', $db);
define('DB_HOST', $host);
define('DB_PORT', $port)

// get functions library
require 'lib.php';
?>