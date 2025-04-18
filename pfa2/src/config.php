<?php
// src/config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change this to your MySQL username
define('DB_PASS', '');         // Change this to your MySQL password
define('DB_NAME', 'healthcare_platform');

// Other configuration constants
define('SITE_URL', 'http://localhost/your-project-name');
define('GOOGLE_MAPS_API_KEY', ''); // You'll need to add your Google Maps API key here

// Error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1); 
