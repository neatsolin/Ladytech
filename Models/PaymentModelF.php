<?php
class PaymentModelF {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "dailyneed_db", "root", "");
    }

    public function savePaymentMethod($user_id, $card_number, $card_holder_name, $expiry_date, $cvv, $currency) {
        try {
            // Log the raw card number
            error_log("PaymentModelF::savePaymentMethod - Raw card_number: " . $card_number);

            // Remove spaces from card number
            $card_number = preg_replace('/\s+/', '', $card_number);

            // Log the card number after removing spaces
            error_log("PaymentModelF::savePaymentMethod - Card_number after removing spaces: " . $card_number);

            // Validate card number: must be exactly 16 digits
            if (!preg_match('/^\d{16}$/', $card_number)) {
                throw new Exception("Card number must be exactly 16 digits (only numbers allowed). Got: " . $card_number);
            }

            // Check if the card number already exists for this user
            $existing = $this->db->query(
                "SELECT id FROM payment_methods WHERE user_id = :user_id AND card_number = :card_number",
                [
                    'user_id' => $user_id,
                    'card_number' => $card_number
                ]
            )->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                error_log("PaymentModelF::savePaymentMethod - Card number already exists for user_id: $user_id, returning existing ID: " . $existing['id']);
                return $existing['id'];
            }

            $result = $this->db->query(
                "INSERT INTO payment_methods (user_id, card_number, card_holder_name, expiry_date, cvv, currency) 
                VALUES (:user_id, :card_number, :card_holder_name, :expiry_date, :cvv, :currency)",
                [
                    'user_id' => $user_id,
                    'card_number' => $card_number,
                    'card_holder_name' => $card_holder_name,
                    'expiry_date' => $expiry_date,
                    'cvv' => $cvv,
                    'currency' => $currency
                ]
            );
            $new_id = $this->db->lastInsertId();
            error_log("PaymentModelF::savePaymentMethod - Successfully saved payment method, new ID: $new_id");
            return $new_id;
        } catch (Exception $e) {
            error_log("Error saving payment method: " . $e->getMessage());
            throw $e;
        }
    }

    public function getPaymentMethodById($payment_method_id) {
        try {
            $result = $this->db->query(
                "SELECT * FROM payment_methods WHERE id = :id",
                ['id' => $payment_method_id]
            );
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching payment method: " . $e->getMessage());
            throw $e;
        }
    }
}