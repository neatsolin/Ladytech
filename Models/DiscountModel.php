<?php
class DiscountModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "ladytech_db", "root", "");
    }
}