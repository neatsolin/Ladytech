<?php

class RegisterModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "dailyneed_db");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    public function registerUser($username, $email, $phone, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Secure password storage

        // Ensure that the bind_param types match the number of variables (5 variables in total)
        $stmt = $this->db->prepare("INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $phone, $hashedPassword, $role); // Correct binding

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>
