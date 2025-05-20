<?php
require_once 'models/Donor.php';
require_once 'ReceiptTemplate.php';
require_once 'strategypattern/IPaymentMethod.php';
require_once 'strategypattern/Ewallet.php';
require_once 'strategypattern/BankCard.php';
require_once 'strategypattern/OnlinePayment.php';

class DonorController {
    private $donorModel;
    private $db;

    public function __construct() {
        $this->donorModel = new Donor();
        $this->db = Database::getInstance();
    }

    private function getLoggedInDonorId() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Donor') {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    
        // Assuming `user_id` in `donor` table matches `user_id` in session
        $userId = $_SESSION['user_id'];
        $query = "SELECT donor_id FROM Donor WHERE user_id = :user_id";
        $result = $this->db->query($query, [':user_id' => $userId]);
    
        if (empty($result)) {
            throw new Exception("No donor associated with the logged-in user.");
        }
    
        return $result[0]['donor_id']; // Assuming the query returns at least one result
    }
    
 
    // Adds a new donor
    public function addDonor($data) {
        $data = [
            ':name' => $data['name'],
            ':contact_info' => $data['contact_info']
        ];
        $result = $this->donorModel->addDonor($data);
        echo $result ? "Donor added successfully." : "Error adding donor.";
    }

    // Retrieves donor information
    public function getDonor($donorId) {
        $donor = $this->donorModel->getDonorById($donorId);
        require 'views/donor/view.php';
    }

    // Updates a donor’s details
    public function updateDonor($donorId, $data) {
        $data[':donor_id'] = $donorId;
        $result = $this->donorModel->updateDonor($data);
        echo $result ? "Donor updated successfully." : "Error updating donor.";
    }

    // List all donors
    public function listDonors() {
        $donors = $this->donorModel->getDonors();
        require 'views/donor/list.php';
    }

    public function addDonation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $donorId = $this->getLoggedInDonorId();
        
                // Verify the donor exists
                $query = "SELECT COUNT(*) AS count FROM Donor WHERE donor_id = :donor_id";
                $result = $this->db->query($query, [':donor_id' => $donorId]);
                if ($result[0]['count'] == 0) {
                    throw new Exception("Error: Donor does not exist. Please contact the administrator.");
                }
        
                $type = $_POST['type']; // "money" or "blood"
                $amount = $_POST['amount'] ?? null;
                $eventId = $_POST['event_id'] ?? null; // Optional event ID
                $date = date('Y-m-d H:i:s');
        
                // Handle money donations with Strategy Pattern
                if ($type === 'money') {
                    $paymentType = $_POST['payment_method']; // Either 'ewallet' or 'bankcard'
                    $paymentMethod = null;
    
                    if ($paymentType === 'ewallet') {
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $paymentMethod = new EWallet($email, $password);
                    } elseif ($paymentType === 'bankcard') {
                        $cardNumber = $_POST['card_number'];
                        $cvv = $_POST['cvv'];
                        $expiryDate = $_POST['expiry_date'];
                        $paymentMethod = new BankCard($cardNumber, $cvv, $expiryDate);
                    } else {
                        throw new Exception("Invalid payment method selected.");
                    }
    
                    // Process the payment
                    if (!$paymentMethod->processPayment((float)$amount)) {
                        throw new Exception("Payment failed. Please try again.");
                    }
                    echo "Payment processed successfully.";
                }
        
                // Insert the donation record
                $query = "INSERT INTO Donation (donor_id, event_id, type, amount, date, method) 
                          VALUES (:donor_id, :event_id, :type, :amount, :date, :method)";
                $params = [
                    ':donor_id' => (int)$donorId,
                    ':event_id' => $eventId ? (int)$eventId : null,
                    ':type' => (string)$type,
                    ':amount' => $amount ? (float)$amount : null,
                    ':date' => (string)$date,
                    ':method'    => $_POST['payment_method'], // e.g. "ewallet" or "bankcard"
                ];
        
                $result = $this->db->execute($query, $params);
        
                if ($result) {
                    // Register the donor as an observer for the event if `event_id` is provided
                    if ($eventId) {
                        $observerQuery = "INSERT IGNORE INTO Event_Observers (event_id, user_id) VALUES (:event_id, :user_id)";
                        $this->db->execute($observerQuery, [':event_id' => $eventId, ':user_id' => $_SESSION['user_id']]);
        
                        // Add notification to the inbox table
                        $notificationQuery = "INSERT INTO Inbox (user_id, message, event_id) 
                                              VALUES (:user_id, :message, :event_id)";
                        $notificationParams = [
                            ':user_id' => $_SESSION['user_id'],
                            ':message' => "Thank you for your contribution to event ID $eventId.",
                            ':event_id' => $eventId,
                        ];
                        $this->db->execute($notificationQuery, $notificationParams);
                    }
        
                    // Redirect to view donations
                    header('Location: index.php?controller=donor&action=viewDonations');
                    exit;
                } else {
                    throw new Exception("Error adding donation. Please try again.");
                }
            } catch (Exception $e) {
                // Display error message
                echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            // Load the donation form view
            $eventId = $_GET['eventId'] ?? null; // Passed from "Contribute" button
            include 'views/donor/add_donation.php';
        }
    }
    
    
    

    public function viewDonations() {
        $donorId = $this->getLoggedInDonorId();
    
        // Fetch donations
        $query = "SELECT * FROM Donation WHERE donor_id = :donor_id";
        $donations = $this->db->query($query, [':donor_id' => $donorId]);
    
        if (empty($donations)) {
            echo "<p>You have no donations yet. Start donating today!</p>";
            return;
        }
    
        include 'views/donor/view_donations.php';
    }
    



    public function downloadReceipt($donationId) {
        if (is_array($donationId)) {
            $donationId = $donationId['donationId'] ?? null;
        }
    
        if (!$donationId || !is_numeric($donationId)) {
            echo "Error: Invalid Donation ID.";
            return;
        }
    
        error_log("Donation ID: " . $donationId);
    
        $query = "SELECT d.*, e.name AS event_name, e.date AS event_date, e.location AS event_location 
                  FROM Donation d
                  LEFT JOIN Event e ON d.event_id = e.event_id
                  WHERE d.donation_id = :donation_id";
    
        $result = $this->db->query($query, [':donation_id' => $donationId]);
        error_log("Query Result: " . print_r($result, true));
    
        if (empty($result)) {
            echo "Error: Donation not found.";
            return;
        }
    
        $donation = $result[0];
        error_log("Donation Data: " . print_r($donation, true));
    
        $receiptGenerator = $donation['event_id'] ? new EventDonationReceipt() : new GeneralDonationReceipt();
        $receipt = $receiptGenerator->generateReceipt($donation);
    
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="receipt_' . $donationId . '.html"');
        echo $receipt;
    }
    
    
    
    
    

    public function viewInbox() {
        $userId = $_SESSION['user_id']; // Get the logged-in user ID
    
        // Fetch notifications
        $query = "SELECT * FROM Inbox WHERE user_id = :user_id ORDER BY timestamp DESC";
        $notifications = $this->db->query($query, [':user_id' => $userId]);
    
        // Mark all notifications as read
        $this->db->execute("UPDATE Inbox SET is_read = TRUE WHERE user_id = :user_id", [':user_id' => $userId]);
    
        include 'views/inbox.php';
    }

    public function view($params = []) {
        // Redirect to viewDonations
        $this->viewDonations();
    }
    
    
    
    
}
?>
