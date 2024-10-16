<?php

namespace pourpro\controllers;

use pourpro\Database;

class FrontController {

    private $input;
    private $db;

    public function __construct($config, $input = "") {
        $this->input = $input;
        $this->db = new Database($config);
    }

    public function run($controllerName, $methodName) {
        // Fully qualify the controller class name with namespace
        $controllerClass = "PourPro\\controllers\\" . ucfirst($controllerName) . "Controller";
        
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass($this->db);
            
            // Check if the method exists in the controller
            if (method_exists($controller, $methodName)) {
                // Call the method
                return $controller->$methodName($this->input);
            } else {
                // Handle method not found
                echo "Method '$methodName' not found in $controllerClass.";
            }
        } else {
            // Handle controller not found
            echo "Controller '$controllerClass' not found.";
        }
    }
}
