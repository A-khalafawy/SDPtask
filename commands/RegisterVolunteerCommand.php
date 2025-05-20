<?php
require_once 'Command.php';
require_once 'models/Event.php';
require_once 'config/Database.php';

class RegisterVolunteerCommand implements Command {
    private $eventId;
    private $volunteerId;
    private $db;

    public function __construct($eventId, $volunteerId) {
        $this->eventId = $eventId;
        $this->volunteerId = $volunteerId;
        $this->db = Database::getInstance();
    }

    // REGISTER (execute)
    public function execute() {
        try {
            // Ensure the volunteer exists in the Attendee table
            $checkQuery = "SELECT COUNT(*) AS count FROM Attendee WHERE attendee_id = :volunteer_id";
            $result = $this->db->query($checkQuery, [':volunteer_id' => $this->volunteerId]);

            if ($result[0]['count'] == 0) {
                $insertQuery = "INSERT INTO Attendee (attendee_id) VALUES (:volunteer_id)";
                $this->db->execute($insertQuery, [':volunteer_id' => $this->volunteerId]);
            }

            // Add to Event_Attendees
            $query = "INSERT INTO Event_Attendees (event_id, attendee_id) VALUES (:event_id, :volunteer_id)";
            $this->db->execute($query, [
                ':event_id' => $this->eventId,
                ':volunteer_id' => $this->volunteerId,
            ]);

            // Add to Event_Observers
            $query = "INSERT INTO Event_Observers (event_id, user_id) VALUES (:event_id, :volunteer_id)";
            $this->db->execute($query, [
                ':event_id' => $this->eventId,
                ':volunteer_id' => $this->volunteerId,
            ]);

            // Notify the volunteer
            $query = "INSERT INTO Inbox (user_id, message) VALUES (:user_id, :message)";
            $message = "You have been registered for Event ID: {$this->eventId}.";
            $this->db->execute($query, [
                ':user_id' => $this->volunteerId,
                ':message' => $message,
            ]);

            echo "Volunteer registered successfully.";
        } catch (Exception $e) {
            echo "Error while registering volunteer: " . $e->getMessage();
        }
    }

    // UNREGISTER (undo)
    public function undo() {
        try {
            // Remove from Event_Attendees
            $query = "DELETE FROM Event_Attendees WHERE event_id = :event_id AND attendee_id = :volunteer_id";
            $this->db->execute($query, [
                ':event_id' => $this->eventId,
                ':volunteer_id' => $this->volunteerId,
            ]);

            // Remove from Event_Observers
            $query = "DELETE FROM Event_Observers WHERE event_id = :event_id AND user_id = :volunteer_id";
            $this->db->execute($query, [
                ':event_id' => $this->eventId,
                ':volunteer_id' => $this->volunteerId,
            ]);

            // Notify the volunteer
            $query = "INSERT INTO Inbox (user_id, message) VALUES (:user_id, :message)";
            $message = "You have been unregistered from Event ID: {$this->eventId}.";
            $this->db->execute($query, [
                ':user_id' => $this->volunteerId,
                ':message' => $message,
            ]);

            echo "Undo successful: Volunteer unregistered.";
        } catch (Exception $e) {
            echo "Error while undoing registration: " . $e->getMessage();
        }
    }
}
?>
