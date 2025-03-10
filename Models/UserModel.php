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

    //add user to the database
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

    // update user in the database
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

    // delete user from the database
    public function deleteUser($id){
        $result = $this->db->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
        return $result;
    }
}