<?php
// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include the Config class
require '/opt/src/pourpro/Config.php';

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        include "/opt/src/pourpro/$classname.php";

});

// Instantiate the configuration
$config = Config::getInstance();

// Instantiate the front controller and pass the config
$pourpro = new PourProController($_GET, $config);

// Run the controller
$pourpro->run();