<?php
// Site Constants 
define('SITE_NAME', 'Rolsa');
define('SITE_DESCRIPTION', 'Green Energy Solutions');

// Error Reporting - this is for development only as it will expose errors
error_reporting(E_ALL);
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);

// Get Base Path for assets
function getBasePath() {
    $path = trim(dirname($_SERVER['PHP_SELF']), '/'); 
    $depth = substr_count($path, '/'); 

    if ($depth == 0) {
        return './'; 
    }

    return str_repeat('../', $depth); 
}
?>

