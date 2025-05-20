<?php
require_once 'models/Donation.php';
require_once 'models/Donor.php';
require_once 'EventManagementFacade.php';
require_once 'ReceiptTemplate.php';
require_once __DIR__ . '/../adapterpattern/EmailAdapter.php';
require_once __DIR__ . '/../adapterpattern/LegacyEmailer.php';


class AdminController {
    private $donationModel;
    private $donorModel;
    private $eventFacade;
    private $emailAdapter;

    public function __construct() {
        $this->donationModel = new Donation();
        $this->donorModel = new Donor();
        $this->eventFacade = new EventManagementFacade(); // Initialize the EventManagementFacade
        $this->emailAdapter = new EmailAdapter(new LegacyEmailer());
    }

    // List all donations with integrated report and sorting
    public function listDonations($params = []) {
        try {
            $column = $params['column'] ?? 'date';
            $order = $params['order'] ?? 'DESC';

            // Fetch sorted donations
            $donations = $this->donationModel->getSortedDonations($column, $order);

            // Calculate the total amount for the report
            $totalAmount = 0;
            foreach ($donations as $donation) {
                $totalAmount += $donation['amount'];
            }

            require 'views/admin/donations.php';
        } catch (Exception $e) {
            error_log("Error fetching donations: " . $e->getMessage());
            echo "An error occurred while fetching donation records.";
        }
    }

    // View details of a specific donor
    public function viewDonor($params) {
        try {
            $donorId = $params['id'] ?? null;
            if (!$donorId) {
                throw new Exception("Invalid donor ID.");
            }

            $donor = $this->donorModel->getDonorById($donorId);
            $transactions = $this->donationModel->getDonorTransactions($donorId);

            if (!$donor) {
                throw new Exception("Donor not found.");
            }

            require 'views/admin/donor_details.php';
        } catch (Exception $e) {
            error_log("Error viewing donor details: " . $e->getMessage());
            echo "An error occurred while fetching donor details.";
        }
    }

    // View event-specific report
    public function viewReport($params) {
        $eventId = $params['event_id'] ?? null;

        if (!$eventId) {
            echo "Error: Event ID is required.";
            return;
        }

        // Generate the report using the facade
        $report = $this->eventFacade->generateReport($eventId);
        $event = $this->eventFacade->getEventDetails($eventId);

        include __DIR__ . '/../views/event/view_report.php';
    }

    // Generate donations report for download
   // Generate donations report for download
   public function generateReport() {
    try {
        $donations = $this->donationModel->getAllDonations(); // Fetch all donation data

        // Generate the report using the template pattern
        $reportGenerator = new DonationsReport();
        $reportContent = $reportGenerator->generateReport($donations);

        // Set headers for CSV download
        $filename = "donations_report_" . date('Y-m-d') . ".csv";
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");

        // Output the generated report
        echo $reportContent;
        exit;
    } catch (Exception $e) {
        error_log("Error generating donation report: " . $e->getMessage());
        echo "An error occurred while generating the report.";
    }
}

    public function sendEmailToDonor($params) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require 'views/donor/send_email.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donor = Database::getInstance()->query(
                "SELECT * FROM Donor WHERE donor_id = :donor_id",
                [':donor_id' => $params['id']]
            )[0];
            $this->emailAdapter->sendMessage(
                $donor['user_id'],      // The internal user ID
                $donor['contact_info'],
                $params['subject'],
                $params['body']
            );
            echo "Email sent successfully to donor.";
        }
    }

    public function sendEmailToVolunteer($params) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require 'views/volunteer/send_email.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $volunteer = Database::getInstance()->query(
                "SELECT * FROM Volunteer WHERE volunteer_id = :volunteer_id",
                [':volunteer_id' => $params['id']]
            )[0];
            $this->emailAdapter->sendMessage(
                $volunteer['user_id'],      // The internal user ID
                $volunteer['contact_info'],
                $params['subject'],
                $params['body']
            );
            echo "Email sent successfully to volunteer.";
        }
    }

}

