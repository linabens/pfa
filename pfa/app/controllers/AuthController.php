<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['login_email'] ?? '';
            $password = $_POST['login_password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['login_error'] = "Email et mot de passe sont requis.";
                header("Location: /public/index.php");
                exit();
            }

            // Check for default admin login
            if ($email === 'admin' && $password === 'admin') {
                $_SESSION['user_id'] = 0;
                $_SESSION['user_email'] = 'admin';
                header("Location: /public/dashboard.php");
                exit();
            }

            if ($this->user->login($email, $password)) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_email'] = $email;
                header("Location: /public/dashboard.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
                header("Location: /public/index.php");
                exit();
            }
        }
        header("Location: /public/index.php");
        exit();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['register_email'] ?? '';
            $password = $_POST['register_password'] ?? '';
            $confirmPassword = $_POST['register_confirm_password'] ?? '';

            $_SESSION['register_email'] = $email;
            $_SESSION['register_errors'] = [];

            // Validate email
            $emailError = $this->user->validateEmail($email);
            if (!empty($emailError)) {
                $_SESSION['register_errors']['email'] = $emailError;
            }

            // Validate password
            $passwordError = $this->user->validatePassword($password);
            if (!empty($passwordError)) {
                $_SESSION['register_errors']['password'] = $passwordError;
            }

            // Validate confirm password
            $confirmPasswordError = $this->user->validateConfirmPassword($password, $confirmPassword);
            if (!empty($confirmPasswordError)) {
                $_SESSION['register_errors']['confirm_password'] = $confirmPasswordError;
            }

            if (empty($_SESSION['register_errors'])) {
                if ($this->user->register($email, $password)) {
                    $_SESSION['success_message'] = "Inscription réussie! Vous pouvez maintenant vous connecter.";
                    unset($_SESSION['register_email']);
                    unset($_SESSION['register_errors']);
                    header("Location: /public/index.php");
                    exit();
                } else {
                    $_SESSION['register_errors']['db'] = "Erreur lors de l'inscription.";
                }
            }
        }
        include __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /public/index.php");
        exit();
    }
}
?> 