<?php

class RegisterModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "ladytech_db", "root", "");
        
    }

    // Check if email already exists in the database
    public function emailExists($email){
        $result = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $result->rowCount() > 0;
    }

    // Register a new user in the database
    public function registerUser($username, $email, $phone, $password, $profile, $role) {
        // Check if email already exists
        if ($this->emailExists($email)) {
            return false; // Or you could throw an exception
        }
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
