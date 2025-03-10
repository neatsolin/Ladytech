<?php

class UserModel {
    private $db;

    public function __construct() {
        // Connect to the database
        $this->db = new mysqli("localhost", "root", "", "dailyneed_db");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch all users from the database
    public function getUsers() {
        $sql = "SELECT id, username, email, phone, profile, role FROM users";
        $result = $this->db->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    // Fetch a single user by ID
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT id, username, email, phone, profile, role FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    // Update a user in the database
    public function updateUser($id, $username, $email, $phone, $role, $profile) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, phone = ?, role = ?, profile = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $username, $email, $phone, $role, $profile, $id);
        return $stmt->execute();
    }

    // Delete a user from the database
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
