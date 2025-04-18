<?php
// src/Models/User.php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register($firstName, $lastName, $email, $password, $phone = null, $needs = null) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (first_name, last_name, email, password_hash, phone_number, needs_description) 
                    VALUES (:firstName, :lastName, :email, :password, :phone, :needs)";
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':phone' => $phone,
                ':needs' => $needs
            ]);
        } catch (PDOException $e) {
            // Log error and return false
            error_log($e->getMessage());
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $user['password_hash'])) {
                    // Start session and store user data
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['first_name'] = $user['first_name'];
                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
