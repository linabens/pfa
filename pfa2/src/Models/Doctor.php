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

// Load controllers
require_once '../src/Controllers/AuthController.php';
require_once '../src/Controllers/FacilityController.php';
require_once '../src/Controllers/AppointmentController.php';
require_once '../src/Controllers/ApiController.php';

// Create controller instances
$authController = new AuthController();
$facilityController = new FacilityController();
$appointmentController = new AppointmentController();
$apiController = new ApiController();

// Basic routing
$route = $_GET['route'] ?? '';

// Include header
require_once '../src/Views/templates/header.php';

// Route to appropriate controller and method
switch($route) {
    // Home page
    case '':
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
        $facilityController->searchFacilities();
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
    
    // API routes (for AJAX calls)
    case 'api/facilities':
        $apiController->getNearbyFacilities();
        break;
    
    default:
        // 404 page
        require_once '../src/Views/pages/404.php';
}

// Include footer only for non-API routes
if (strpos($route, 'api/') !== 0) {
    require_once '../src/Views/templates/footer.php';
}
