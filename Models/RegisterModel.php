<?php

class RegisterModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
        
    }

    // Register a new user in the database
    public function registerUser($username, $email, $phone, $password, $profile, $role) {
        // Normalize role to 'users' if it's not 'users'
        $role = ($role === 'users') ? 'users' : $role;
        $result = $this->db->query("INSERT INTO users (username, email, phone, password, profile, role) VALUES (:username, :email, :phone, :password, :profile, :role)",[
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'profile' => $profile
            
        ]);
        return $result;

    }
}
?>
