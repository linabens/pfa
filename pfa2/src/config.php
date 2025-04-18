<?php
// src/config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change this to your MySQL username
define('DB_PASS', '');         // Change this to your MySQL password
define('DB_NAME', 'healthcare_platform');

// Other configuration constants
define('SITE_URL', 'http://localhost/your-project-name');
define('GOOGLE_MAPS_API_KEY', ''); // You'll need to add your Google Maps API key here

// Error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1); 
<?php
// src/Models/Facility.php

class Facility {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getAllFacilities() {
        try {
            $sql = "SELECT * FROM facilities";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function getFacilityById($id) {
        try {
            $sql = "SELECT * FROM facilities WHERE facility_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function getFacilityAccessibilityFeatures($facilityId) {
        try {
            $sql = "SELECT af.* FROM accessibility_features af
                    JOIN facility_accessibility fa ON af.feature_id = fa.feature_id
                    WHERE fa.facility_id = :facility_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':facility_id' => $facilityId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function getNearbyFacilities($lat, $lng, $radius = 10) {
        try {
            // Using the Haversine formula to calculate distance
            $sql = "SELECT *, 
                    (6371 * acos(cos(radians(:lat)) * cos(radians(latitude)) * 
                    cos(radians(longitude) - radians(:lng)) + sin(radians(:lat)) * 
                    sin(radians(latitude)))) AS distance 
                    FROM facilities 
                    HAVING distance < :radius 
                    ORDER BY distance";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':lat' => $lat,
                ':lng' => $lng,
                ':radius' => $radius
            ]);
            
            $facilities = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Fetch accessibility features for each facility
            foreach ($facilities as &$facility) {
                $facility['accessibility_features'] = $this->getFacilityAccessibilityFeatures($facility['facility_id']);
            }
            
            return $facilities;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
