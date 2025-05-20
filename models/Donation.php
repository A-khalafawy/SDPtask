<?php
require_once 'config/Database.php';

class Donation {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Fetch all donations
    public function getAllDonations() {
        $query = "SELECT donation_id, type, donor_id, amount, date 
                  FROM Donation 
                  ORDER BY date DESC";
        return $this->db->query($query);
    }    

    // Fetch sorted donations
    public function getSortedDonations($column = 'date', $order = 'DESC') {
        $allowedColumns = ['donation_id', 'type', 'donor_id', 'amount', 'date'];
        $allowedOrder = ['ASC', 'DESC'];

        // Validate input to prevent SQL injection
        if (!in_array($column, $allowedColumns)) {
            $column = 'date';
        }
        if (!in_array($order, $allowedOrder)) {
            $order = 'DESC';
        }

        $query = "SELECT donation_id, type, donor_id, amount, date 
                  FROM Donation 
                  ORDER BY $column $order";
        return $this->db->query($query);
    }

    // Fetch transactions for a specific donor
    public function getDonorTransactions($donorId) {
        $query = "SELECT d.donation_id, d.type, r.amount, r.date_issued 
                  FROM Donation d
                  LEFT JOIN Receipt r ON d.donation_id = r.donation_id
                  WHERE d.donor_id = :donor_id
                  ORDER BY r.date_issued DESC";
        return $this->db->query($query, [':donor_id' => $donorId]);
    }

    // Fetch total donation amount
    public function getTotalDonations() {
        $query = "SELECT SUM(r.amount) AS total_amount 
                  FROM Receipt r";
        $result = $this->db->query($query);
        return $result[0]['total_amount'] ?? 0;
    }

    // Fetch latest donation
    public function getLatestDonation() {
        $query = "SELECT d.donation_id, d.type, d.donor_id, r.amount, r.date_issued 
                  FROM Donation d
                  LEFT JOIN Receipt r ON d.donation_id = r.donation_id
                  ORDER BY r.date_issued DESC
                  LIMIT 1";
        $result = $this->db->query($query);
        return $result[0] ?? null;
    }

    // Fetch donations grouped by type
    public function getDonationsByType() {
        $query = "SELECT d.type, COUNT(d.donation_id) AS count, SUM(r.amount) AS total_amount
                  FROM Donation d
                  LEFT JOIN Receipt r ON d.donation_id = r.donation_id
                  GROUP BY d.type
                  ORDER BY total_amount DESC";
        return $this->db->query($query);
    }

    public function getTransactionsByDonationId($donationId) {
        $query = "SELECT * FROM Transactions WHERE donation_id = :donation_id";
        return $this->db->query($query, [':donation_id' => $donationId]);
    }
    
}
