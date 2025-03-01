<?php
    //class for database
    class Database{
        private $db;


        //constructor to connect to database
        public function __construct($hostname, $dbname, $username, $password){
            $dsn = "mysql:host=$hostname;dbname=$dbname;charset=UFT8";

            try{
                $this->db = new PDO($dsn, $username, $password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }

        }
        

        //Execute the query SQL statement with optional parameters
        public function query($sql, $params = []){
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
            
    }
?>