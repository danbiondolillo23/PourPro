<?php

namespace pourpro\controllers;

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Assuming you need the database instance
    }

    public function login($input) {
        // Logic for logging in, e.g., validating input, checking user credentials
        // Example:
        echo "Login method called.";
    }

    public function signup($input) {
        // Logic for signing up
        echo "Signup method called.";
    }
}