<?php
// src/Models/Doctor.php

class Doctor {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAllDoctors() {
        try {
            $sql = "SELECT d.*, f.name AS facility_name 
                    FROM doctors d
                    LEFT JOIN facilities f ON d.facility_id = f.facility_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function getDoctorById($id) {
        try {
            $sql = "SELECT d.*, f.name AS facility_name, f.address AS facility_address 
                    FROM doctors d
                    LEFT JOIN facilities f ON d.facility_id = f.facility_id
                    WHERE d.doctor_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function getDoctorsByFacility($facilityId) {
        try {
            $sql = "SELECT * FROM doctors WHERE facility_id = :facility_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':facility_id' => $facilityId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function getDoctorsBySpecialty($specialty) {
        try {
            $sql = "SELECT d.*, f.name AS facility_name 
                    FROM doctors d
                    LEFT JOIN facilities f ON d.facility_id = f.facility_id
                    WHERE d.specialty LIKE :specialty";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':specialty' => '%' . $specialty . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
