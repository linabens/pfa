<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validateEmail($email) {
        if (empty($email)) {
            return "L'email est requis";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Format d'email invalide";
        }
        $stmt = $this->conn->prepare("SELECT id FROM " . $this->table_name . " WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return "Cet email est déjà utilisé.";
        }
        $stmt->close();
        return "";
    }

    public function validatePassword($password) {
        if (empty($password)) {
            return "Le mot de passe est requis";
        }
        if (strlen($password) < 8) {
            return "Le mot de passe doit contenir au moins 8 caractères";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            return "Le mot de passe doit contenir au moins une majuscule";
        }
        if (!preg_match("/[a-z]/", $password)) {
            return "Le mot de passe doit contenir au moins une minuscule";
        }
        if (!preg_match("/[0-9]/", $password)) {
            return "Le mot de passe doit contenir au moins un chiffre";
        }
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]|\[|\]/", $password)) {
            return "Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*()-_=+{};:,<.>[]).";
        }
        return "";
    }

    public function validateConfirmPassword($password, $confirmPassword) {
        if (empty($confirmPassword)) {
            return "La confirmation du mot de passe est requise";
        }
        if ($password !== $confirmPassword) {
            return "Les mots de passe ne correspondent pas";
        }
        return "";
    }

    public function login($email, $password) {
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($this->id, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                return true;
            }
        }
        return false;
    }

    public function register($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table_name . " (email, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $hashedPassword);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?> 