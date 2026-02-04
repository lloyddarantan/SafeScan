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
                        first_name = ?, 
                        last_name = ?, 
                        email = ?, 
                        phone = ?, 
                        street = ?
                    WHERE user_id = ?";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                $data['firstname'],
                $data['lastname'],
                $data['email'],
                $data['contact'],
                $data['street'],
                $id
            ]);
        }

    public function deleteAccount($id) {
            $sql = "DELETE FROM users WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        }

}
