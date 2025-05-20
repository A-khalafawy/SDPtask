<?php

abstract class ReceiptTemplate {
    public function generateReceipt($donation) {
        $receipt = $this->generateHeader();
        $receipt .= $this->generateBody($donation);
        $receipt .= $this->generateFooter();
        return $receipt;
    }

    protected function generateHeader() {
        return "<h1>Donation Receipt</h1>";
    }

    protected abstract function generateBody($donation);

    protected function generateFooter() {
        return "<p>Thank you for your generous support!</p>";
    }
}

class GeneralDonationReceipt extends ReceiptTemplate {
    protected function generateBody($donation) {
        return "<p>Donation ID: " . htmlspecialchars($donation['donation_id']) . "</p>" .
               "<p>Amount: $" . htmlspecialchars($donation['amount']) . "</p>" .
               "<p>Date: " . htmlspecialchars($donation['date']) . "</p>";
    }
}

class EventDonationReceipt extends ReceiptTemplate {
    protected function generateBody($donation) {
        $body = "<p>Donation ID: " . htmlspecialchars($donation['donation_id']) . "</p>" .
                "<p>Amount: $" . htmlspecialchars($donation['amount']) . "</p>" .
                "<p>Date: " . htmlspecialchars($donation['date']) . "</p>";
        if (!empty($donation['event_name'])) {
            $body .= "<p>Event: " . htmlspecialchars($donation['event_name']) . "</p>" .
                     "<p>Event Date: " . htmlspecialchars($donation['event_date']) . "</p>" .
                     "<p>Event Location: " . htmlspecialchars($donation['event_location']) . "</p>";
        }
        return $body;
    }
}





abstract class ReportTemplate {
    public function generateReport($donations) {
        $report = $this->generateHeader();
        $report .= $this->generateBody($donations);
        $report .= $this->generateFooter();
        return $report;
    }

    protected function generateHeader() {
        return "Donation ID,Type,Donor ID,Amount,Date\n";
    }

    protected abstract function generateBody($donations);

    protected function generateFooter() {
        return "\nReport generated successfully.";
    }

}


class DonationsReport extends ReportTemplate {
    protected function generateBody($donations) {
        $body = "";
        foreach ($donations as $donation) {
            $body .= htmlspecialchars($donation['donation_id']) . "," .
                     htmlspecialchars($donation['type']) . "," .
                     htmlspecialchars($donation['donor_id']) . "," .
                     htmlspecialchars($donation['amount']) . "," .
                     htmlspecialchars($donation['date']) . "\n";
        }
        return $body;
    }
}





class FileDownloadReport extends ReportTemplate {
    private $filename;

    public function __construct($filename = "report.csv") {
        $this->filename = $filename;
    }

    public function downloadReport($donations) {
        $reportContent = $this->generateReport($donations);

        // Send file headers for download
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename={$this->filename}");

        // Output the report content
        echo $reportContent;
        exit; // Ensure no additional output is sent
    }

    protected function generateBody($donations) {
        $body = "";
        foreach ($donations as $donation) {
            $body .= htmlspecialchars($donation['donation_id']) . "," .
                     htmlspecialchars($donation['type']) . "," .
                     htmlspecialchars($donation['donor_id']) . "," .
                     htmlspecialchars($donation['amount']) . "," .
                     htmlspecialchars($donation['date']) . "\n";
        }
        return $body;
    }
}