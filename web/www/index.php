<?php
// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include Composer's autoload file
require '/opt/src/pourpro/vendor/autoload.php';

// Start session once in the main file
session_start();

// Check if the user is logged in
$isAuthenticated = isset($_SESSION['user_id']);  // Example session variable for user authentication

// Parse the URI to get the controller and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriSegments = explode('/', trim($uri, '/'));

// Default controller and method
$controllerName = !empty($uriSegments[1]) ? $uriSegments[1] : 'auth';
$methodName = !empty($uriSegments[2]) ? $uriSegments[2] : 'login';

// Ensure that the login page is accessible even without authentication
$publicRoutes = [
    'auth/login',
    'auth/signup'
];

// If the user is not authenticated and the route is not public, redirect to login
if (!$isAuthenticated && !in_array("{$controllerName}/{$methodName}", $publicRoutes)) {
    // Redirect to login page
    header('Location: /auth/login');
    exit();
}

use pourpro\Config;
// Instantiate the db configuration
$config = Config::getInstance();

// Use the FrontController
$frontController = new PourPro\controllers\FrontController($config);

// Run the controller with the specified method
$frontController->run($controllerName, $methodName);
