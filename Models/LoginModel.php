<?php
class LoginModel {
    private $db;

    // Constructor to connect to the database
    public function __construct() {
        $this->db = new Database("localhost", "ladytech_db", "root", "");
    }

    // Fetch user by email for authentication
    public function getUserByEmail($email) {
        $result = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

}
?>
