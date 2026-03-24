<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO users 
                (first_name, last_name, country, province, city, street, phone, email, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['country'],
            $data['province'],
            $data['city'],
            $data['street'],
            $data['phone'],
            $data['email'],
            $hashedPassword
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $data) {
        $sql = "UPDATE users SET 
                first_name = :firstname, 
                last_name = :lastname, 
                email = :email, 
                phone = :contact, 
                street = :street,
                city = :city,
                province = :province,
                country = :country";

        if (isset($data['password'])) {
            $sql .= ", password = :password";
        }

        $sql .= " WHERE user_id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':firstname', $data['firstname']);
        $stmt->bindValue(':lastname',  $data['lastname']);
        $stmt->bindValue(':email',     $data['email']);
        $stmt->bindValue(':contact',   $data['contact']);
        $stmt->bindValue(':street',    $data['street']);
        $stmt->bindValue(':city',      $data['city']);
        $stmt->bindValue(':province',  $data['province']);
        $stmt->bindValue(':country',   $data['country']);
        $stmt->bindValue(':id',        $id);

        if (isset($data['password'])) {
            $stmt->bindValue(':password', $data['password']);
        }

        return $stmt->execute();
    }

    public function deleteAccount($id) {
            $sql = "DELETE FROM users WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
    }

   public function getSavedAppliances($userId) {
    
        $sql = "SELECT a.* FROM appliance a 
                JOIN favorites f ON a.appliance_id = f.appliance_id 
                WHERE f.user_id = ?";
                
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// otp
    public function saveOTP($email, $otp) {
        $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $stmt = $this->conn->prepare("
            UPDATE users 
            SET otp_code = ?, otp_expiry = ? 
            WHERE email = ?
        ");
        return $stmt->execute([$otp, $expiry, $email]);
    }

    public function verifyOTP($email, $otp) {
        $stmt = $this->conn->prepare("
            SELECT * FROM users 
            WHERE email = ? 
            AND otp_code = ? 
            AND otp_expiry > NOW()
        ");
        $stmt->execute([$email, $otp]);
        return $stmt->fetch();
    }

    public function updatePassword($email, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("
            UPDATE users 
            SET password = ?, otp_code = NULL, otp_expiry = NULL
            WHERE email = ?
        ");
        return $stmt->execute([$hashed, $email]);
    }
}
