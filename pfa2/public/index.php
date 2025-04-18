<?php
// public/index.php

session_start();
require_once '../src/config.php';
require_once '../src/Lib/Database.php';

// Load models
require_once '../src/Models/User.php';
require_once '../src/Models/Facility.php';
require_once '../src/Models/Doctor.php';
require_once '../src/Models/Appointment.php';
require_once '../src/Models/Notification.php';

// Load controllers
require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/FacilityController.php';
require_once '../src/Controllers/AppointmentController.php';
require_once '../src/Controllers/ApiController.php';
require_once '../src/Controllers/UserController.php';
require_once '../src/Controllers/NotificationController.php';

// Create controller instances
$authController = new AuthController();
$facilityController = new FacilityController();
$appointmentController = new AppointmentController();
$apiController = new ApiController();
$userController = new UserController();
$notificationController = new NotificationController();

// Basic routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$route = $uri ?: 'home';

// API routes don't need header/footer
if (strpos($route, 'api/') === 0) {
    switch ($route) {
        case 'api/facilities':
            $apiController->getNearbyFacilities();
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'API endpoint not found']);
            break;
    }
    exit;
}

// Include header for non-API routes
require_once '../src/Views/templates/header.php';

// Route to appropriate controller and method
switch($route) {
    // Home page
    case 'home':
        require_once '../src/Views/pages/home.php';
        break;
    
    // Authentication routes
    case 'login':
        $authController->login();
        break;
    case 'login-process':
        $authController->loginProcess();
        break;
    case 'register':
        $authController->register();
        break;
    case 'register-process':
        $authController->registerProcess();
        break;
    case 'logout':
        $authController->logout();
        break;
    
    // User profile routes
    case 'dashboard':
        $userController->dashboard();
        break;
    case 'profile':
        $userController->profile();
        break;
    case 'update-profile':
        $userController->updateProfile();
        break;
    
    // Notification routes
    case 'notifications':
        $notificationController->viewNotifications();
        break;
    case 'mark-read':
        $notificationController->markAsRead();
        break;
    case 'mark-all-read':
        $notificationController->markAllAsRead();
        break;
    
    // Facility and doctor routes
    case 'facilities':
        $facilityController->viewFacilities();
        break;
    case 'facility':
        $facilityController->viewFacilityDetails();
        break;
    case 'doctors':
        $facilityController->viewDoctors();
        break;
    case 'doctor':
        $facilityController->viewDoctorDetails();
        break;
    case 'search':
        $facilityController->showAdvancedSearch();
        break;
    case 'search-results':
        $facilityController->searchResults();
        break;
    
    // Appointment routes
    case 'appointments':
        $appointmentController->viewAppointments();
        break;
    case 'book-appointment':
        $appointmentController->bookAppointment();
        break;
    case 'process-booking':
        $appointmentController->processBooking();
        break;
    case 'cancel-appointment':
        $appointmentController->cancelAppointment();
        break;
    
    default:
        // 404 page
        http_response_code(404);
        require_once '../src/Views/pages/404.php';
}

// Include footer for non-API routes
require_once '../src/Views/templates/footer.php';
