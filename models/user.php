<?php
require_once 'config/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createUser($username, $password, $role) {
        $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $params = [
            ':username' => $username,
            ':password' => $password,
            ':role' => $role
        ];

        if ($this->db->execute($query, $params)) {
            return $this->db->lastInsertId(); // Return the created user ID
        }
        return false;
    
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username";
        $user = $this->db->query($query, [':username' => $username]);
        if ($user && password_verify($password, $user[0]['password'])) {
            return $user[0];
        }
        return false;
    }

    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        return $this->db->query($query, [':user_id' => $userId])[0] ?? null;
    }
}
?>
