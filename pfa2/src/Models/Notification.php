<?php
// src/Models/Notification.php

class Notification {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getUserNotifications($userId) {
        try {
            $sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function markAsRead($notificationId, $userId) {
        // Implementation of markAsRead method
    }
    
    public function markAllAsRead($userId) {
        // Implementation of markAllAsRead method
    }
}
