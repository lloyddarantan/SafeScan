<?php
require_once __DIR__ . '/../config/Database.php';

class Admin {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getStats() {
        $stmtUsers = $this->conn->query("SELECT COUNT(*) FROM users");
        $userCount = $stmtUsers->fetchColumn();

        $stmtApps = $this->conn->query("SELECT COUNT(*) FROM appliance");
        $appCount = $stmtApps->fetchColumn();

        return [
            'users' => $userCount,
            'appliances' => $appCount
        ];
    }

    public function getAllUsers() {
        $sql = "SELECT 
                    user_id, 
                    CONCAT(first_name, ' ', last_name) as name, 
                    role, 
                    city as loc, 
                    DATE_FORMAT(date_registered, '%b %d, %Y') as joined 
                FROM users 
                ORDER BY date_registered DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserRole($userId, $newRole) {
        $sql = "UPDATE users SET role = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$newRole, $userId]);
    }

    public function getAdminProfile($id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAdminProfile($id, $data) {
        $sql = "UPDATE users SET 
                first_name = ?, 
                last_name = ?, 
                email = ?, 
                phone = ? 
                WHERE user_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $id
        ]);
    }

    public function getAllAppliances() {
        $sql = "SELECT 
                    appliance_id, 
                    brand,
                    category,
                    `group` as 'group', 
                    type, 
                    wattage as watt, 
                    energy_consumption as cons, 
                    description,
                    image,
                    'N/A' as date 
                FROM appliance 
                ORDER BY appliance_id DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function createAppliance($data) {
        $sql = "INSERT INTO appliance 
                (brand, category, `group`, type, wattage, energy_consumption, description, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['brand'],
            $data['category'],
            $data['group'],
            $data['type'],
            $data['watt'],
            $data['cons'],
            $data['description'],
            $data['image']
        ]);
    }

    public function deleteAppliance($applianceId) {
        $sql = "DELETE FROM appliance WHERE appliance_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$applianceId]);
    }
}
?>