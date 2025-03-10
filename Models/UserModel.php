<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "dailyneed_db");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch all users
    public function getUsers() {
        $query = "SELECT id, username, email, phone, profile, role FROM users";
        $result = $this->db->query($query);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }
}
