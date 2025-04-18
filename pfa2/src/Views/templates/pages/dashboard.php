<?php
// src/Controllers/UserController.php

class UserController {
    private $userModel;
    private $appointmentModel;
    private $facilityModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->appointmentModel = new Appointment();
        $this->facilityModel = new Facility();
    }
    
    public function dashboard() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Veuillez vous connecter pour accéder à votre tableau de bord.";
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        
        // Get upcoming appointments
        $appointments = $this->appointmentModel->getAppointmentsByUser($userId);
        $upcomingAppointments = [];
        $completedAppointments = [];
        
        foreach ($appointments as $appointment) {
            if ($appointment['status'] == 'scheduled' && strtotime($appointment['appointment_datetime']) > time()) {
                $upcomingAppointments[] = $appointment;
            } else if ($appointment['status'] == 'completed' || strtotime($appointment['appointment_datetime']) < time()) {
                $completedAppointments[] = $appointment;
            }
        }
        
        // Get favorite facilities
        $favoritesFacilities = []; // This would be implemented with a separate model
        
        // Get recommended facilities based on user preferences
        $recommendedFacilities = $this->getRecommendedFacilities($userId);
        
        require_once '../src/Views/pages/dashboard.php';
    }
    
    public function profile() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Veuillez vous connecter pour accéder à votre profil.";
            header('Location: /login');
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($userId);
        
        if (!$user) {
            $_SESSION['error'] = "Utilisateur introuvable.";
            header('Location: /dashboard');
            exit;
        }
        
        // Get all accessibility features for preferences
        // In a real implementation, you'd have a model for this
        $accessibilityFeatures = $this->getAccessibilityFeatures();
        
        // Get user's accessibility preferences
        // In a real implementation, you'd get this from a user_preferences table
        $userPreferences = [];
        
        require_once '../src/Views/pages/profile.php';
    }
    
    public function updateProfile() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Veuillez vous connecter pour modifier votre profil.";
            header('Location: /login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $needs = $_POST['needs_description'] ?? '';
            
            // Basic validation
            if (empty($firstName) || empty($lastName) || empty($email)) {
                $_SESSION['error'] = "Les champs obligatoires doivent être remplis.";
                header('Location: /profile');
                exit;
            }
            
            // Update user profile
            $success = $this->userModel->updateProfile($userId, $firstName, $lastName, $email, $phone, $needs);
            
            // Handle password change if requested
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if (!empty($currentPassword) && !empty($newPassword)) {
                if ($newPassword !== $confirmPassword) {
                    $_SESSION['error'] = "Les nouveaux mots de passe ne correspondent pas.";
                    header('Location: /profile');
                    exit;
                }
                
                if (!$this->userModel->verifyPassword($userId, $currentPassword)) {
                    $_SESSION['error'] = "Mot de passe actuel incorrect.";
                    header('Location: /profile');
                    exit;
                }
                
                $passwordSuccess = $this->userModel->updatePassword($userId, $newPassword);
                if (!$passwordSuccess) {
                    $_SESSION['error'] = "Échec de la mise à jour du mot de passe.";
                    header('Location: /profile');
                    exit;
                }
            }
            
            // Handle accessibility preferences
            $accessibilityFeatures = $_POST['accessibility_features'] ?? [];
            // Update user preferences (this would be implemented with a separate model)
            
            if ($success) {
                // Update session data
                $_SESSION['first_name'] = $firstName;
                $_SESSION['last_name'] = $lastName;
                $_SESSION['email'] = $email;
                
                $_SESSION['success'] = "Profil mis à jour avec succès.";
            } else {
                $_SESSION['error'] = "Échec de la mise à jour du profil.";
            }
            
            header('Location: /profile');
            exit;
        }
    }
    
    // Helper method to get all accessibility features
    private function getAccessibilityFeatures() {
        try {
            $sql = "SELECT * FROM accessibility_features";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    // Helper method to get recommended facilities
    private function getRecommendedFacilities($userId) {
        // In a real implementation, you'd recommend based on user preferences
        // For now, just return some random facilities
        return $this->facilityModel->getAllFacilities();
    }
}
