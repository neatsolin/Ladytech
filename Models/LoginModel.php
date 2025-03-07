<?php
require_once "Database/database.php";

class LoginModel {
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    // Function to insert a new user into the database
    public function insertUser($username, $email, $phone, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        $query = "INSERT INTO users (username, email, phone, password, role) 
                  VALUES (:username, :email, :phone, :password, :role)";
                  
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ":username" => $username,
            ":email"    => $email,
            ":phone"    => $phone,
            ":password" => $hashedPassword,
            ":role"     => $role
        ]);
    }

    // Function to check if a user exists
    public function checkUserExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Function to check user login
    public function authenticate($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false; 
    }
}
?>
