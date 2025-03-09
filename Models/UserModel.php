<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "dailyneed_db");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    public function getAllUsers() {
        $sql = "SELECT id, username, email, phone, password, profile, role FROM users";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC); // Return all rows as an associative array
        } else {
            return null;
        }
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($username, $email, $phone, $password, $role, $profile) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, phone, password, role, profile) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $email, $phone, $password, $role, $profile);
        return $stmt->execute();
    }

    public function updateUser($id, $username, $email, $phone, $password, $role, $profile) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, phone = ?, password = ?, role = ?, profile = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $username, $email, $phone, $password, $role, $profile, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function close() {
        $this->db->close();
    }
}

?>
