<?php
// public/index.php

session_start();
require_once '../src/config.php';
require_once '../src/Lib/Database.php';
require_once '../src/Models/User.php';

// Basic routing
$route = $_GET['route'] ?? 'home';

// Include header
require_once '../src/Views/templates/header.php';

// Route to appropriate page
switch($route) {
    case 'home':
        require_once '../src/Views/pages/home.php';
        break;
    case 'login':
        require_once '../src/Views/pages/login.php';
        break;
    case 'register':
        require_once '../src/Views/pages/register.php';
        break;
    default:
        // 404 page
        require_once '../src/Views/pages/404.php';
}

// Include footer
require_once '../src/Views/templates/footer.php'; 
