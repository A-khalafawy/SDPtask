<?php

require_once 'models/Communication.php';

class CommunicationController {
    private $communicationModel;

    public function __construct() {
        $this->communicationModel = new Communication();
    }

    // Send a message using the specified strategy
    public function sendMessage($data) {
        $type = $data['type'];
        $recipient = $data['recipient'];
        $message = $data['message'];

        // Send the message using the specified strategy
        $this->communicationModel->sendMessage($type, $recipient, $message);

        // Add the communication to the database
        $data['date_sent'] = date('Y-m-d'); // Add current date
        $result = $this->communicationModel->addCommunication($data);
        echo $result ? "Message sent successfully." : "Error sending message.";
    }

    // List all communications
    public function listCommunications() {
        $communications = $this->communicationModel->getCommunications();
        require 'views/communications/list.php'; // Display list of communications
    }

    // Get a specific communication
    public function getCommunication($id) {
        $communication = $this->communicationModel->getCommunicationById($id);
        require 'views/communications/view.php'; // Display communication details
    }

    // Update an existing communication
    public function updateCommunication($id, $data) {
        $result = $this->communicationModel->updateCommunication($id, $data);
        echo $result ? "Communication updated successfully." : "Error updating communication.";
    }

}
?>
