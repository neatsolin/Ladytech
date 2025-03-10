<?php

class RegisterModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "dailyneed_db");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    public function registerUser($username, $email, $phone, $password, $role, $profileImage) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Secure password storage

        // Use a default image if no profile image is provided
        if (empty($profileImage)) {
            $profileImage = 'uploads/profiles/default.png'; // Replace with your default image path
        }

        if (!empty($role)) {
            // If a role is provided, insert it
            $stmt = $this->db->prepare("INSERT INTO users (username, email, phone, password, role, profile) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $email, $phone, $hashedPassword, $role, $profileImage);
        } else {
            // If no role is provided, insert without it
            $stmt = $this->db->prepare("INSERT INTO users (username, email, phone, password, profile) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $email, $phone, $hashedPassword, $profileImage);
        }

        return $stmt->execute();
    }
}
?>
