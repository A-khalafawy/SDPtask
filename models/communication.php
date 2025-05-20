<?php
require_once 'MessageStrategies.php'; 
require_once 'config/Database.php';

class Communication {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance(); // Use Singleton for database instance
    }

    public function getCommunications() {
        $query = "SELECT * FROM communication";
        return $this->db->query($query);
    }

    public function getCommunicationById($communicationId) {
        $query = "SELECT * FROM communication WHERE communication_id = :communication_id";
        $result = $this->db->query($query, [':communication_id' => $communicationId]);
        if ($result === false || count($result) === 0) {
            return null;
        }
        return $result[0];
    }

    public function addCommunication($data) {
        $query = "INSERT INTO communication (type, message, recipient, date_sent) 
                  VALUES (:type, :message, :recipient, :date_sent)";
        return $this->db->execute($query, $data);
    }

    public function updateCommunication($communicationId, $data) {
        $query = "UPDATE communication 
                  SET type = :type, message = :message, recipient = :recipient, date_sent = :date_sent 
                  WHERE communication_id = :communication_id";
        return $this->db->execute($query, array_merge($data, [':communication_id' => $communicationId]));
    }

    public function deleteCommunication($communicationId) {
        $query = "DELETE FROM communication WHERE communication_id = :communication_id";
        return $this->db->execute($query, [':communication_id' => $communicationId]);
    }

    public function sendMessage($type, $recipient, $message) {
        $strategy = $this->getStrategy($type);
        $strategy->send($recipient, $message);
    }

    private function getStrategy($type) {
        switch ($type) {
            case 'email':
                return new EmailStrategy();
            case 'sms':
                return new SMSStrategy();
            case 'social_media':
                return new SocialMediaStrategy();
            default:
                throw new Exception("Unknown communication type: $type");
        }
    }
}

?>
