<?php
session_start();
require_once __DIR__ . '/../app/controllers/AuthController.php';

$action = $_GET['action'] ?? '';
$page = $_GET['page'] ?? '';

// Handle authentication actions
switch ($action) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
    case 'register':
        $auth = new AuthController();
        $auth->register();
        break;
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
    default:
        // Handle page requests
        switch ($page) {
            case 'dashboard':
                if (!isset($_SESSION['user_id'])) {
                    header("Location: /public/index.php");
                    exit();
                }
                include __DIR__ . '/../app/views/dashboard/index.php';
                break;
            case 'services':
            case 'about':
            case 'doctors':
            case 'contact':
                if (!isset($_SESSION['user_id'])) {
                    header("Location: /public/index.php");
                    exit();
                }
                include __DIR__ . '/../app/views/pages/' . $page . '.php';
                break;
            default:
                // Show login/register page
                include __DIR__ . '/index.html';
                break;
        }
        break;
}
?> 