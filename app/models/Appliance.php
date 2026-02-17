<?php
require_once __DIR__ . '/../config/Database.php';

class Appliance {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllAppliances() {
        $sql = "SELECT *, appliance_id AS id FROM appliance ORDER BY type, brand";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateAmperes($watts, $voltage = 220) {
        if (!$watts || $voltage <= 0) {
            return 0;
        }

        return round($watts / $voltage, 2);
    }
}