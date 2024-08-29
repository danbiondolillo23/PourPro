<?php
// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

require '/opt/src/pourpro/PourPro/vendor/autoload.php';

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        $classname = str_replace('\\', '/', $classname);
        include "/opt/src/pourpro/PourPro/{$classname}.php";
    });

// Instantiate the db configuration
$config = Config::getInstance();

// Instantiate the front controller and pass the db config
$pourpro = new PourProController($_GET, $config);

// Run the front controller
$pourpro->run();