<?php

class UserModel {
    private $db;

    // initial to start connect to the database
    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    // Fetch all users from the database
    public function getUsers() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single user by ID
    public function getUserById($id) {
        $result = $this->db->query("SELECT * FROM users WHERE id = :id", ['id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Add user to the database
    public function addUser($username, $email, $phone, $password, $profile, $role){
        $result = $this->db->query("INSERT INTO users (username, email, phone, password, profile, role) VALUES (:username, :email, :phone, :password, :profile, :role)",[
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'profile' => $profile,
            'role' => $role
        ]);
        return $result;
    }

    // Update user in the database
    public function updateUser($id, $username, $email, $phone, $profile, $role){
        $result = $this->db->query("UPDATE users SET username = :username, email = :email, phone = :phone, profile = :profile, role = :role WHERE id = :id", [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'profile' => $profile,
            'role' => $role
        ]);
        return $result;
    }

    // Delete user and all dependencies
    public function deleteUser($id){
        // Step 1: Delete related rows in child tables
        $this->db->query("DELETE FROM notifications WHERE user_id = :id", ['id' => $id]);
        $this->db->query("DELETE FROM payment_methods WHERE user_id = :id", ['id' => $id]);
        $this->db->query("DELETE FROM reviews WHERE user_id = :id", ['id' => $id]);
        $this->db->query("DELETE FROM shoppingcards WHERE user_id = :id", ['id' => $id]);

        // Step 2: Delete related rows in the `orders` table and its child tables
        // Delete from `transactions` first
        $this->db->query("DELETE FROM transactions WHERE order_id IN (SELECT id FROM orders WHERE user_id = :id)", ['id' => $id]);

        // Delete from `orderitems` next
        $this->db->query("DELETE FROM orderitems WHERE order_id IN (SELECT id FROM orders WHERE user_id = :id)", ['id' => $id]);

        // Finally, delete from `orders`
        $this->db->query("DELETE FROM orders WHERE user_id = :id", ['id' => $id]);

        // Step 3: Delete the user
        $result = $this->db->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
        return $result;
    }
}