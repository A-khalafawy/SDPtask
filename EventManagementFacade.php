<?php
require_once 'models/Event.php';
require_once 'models/Volunteer.php';
require_once 'config/Database.php';

class EventManagementFacade {
    private $eventModel;
    private $volunteerModel;
    private $db;

    public function __construct() {
        $this->eventModel = new Event();
        $this->volunteerModel = new Volunteer();
        $this->db = Database::getInstance();
    }

    // Create a new event
    public function createEvent($eventData) {
        try {
            $result = $this->eventModel->addEvent($eventData);
            return $result ? "Event created successfully." : "Failed to create event.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Update an existing event
    public function updateEvent($eventId, $eventData) {
        try {
            $result = $this->eventModel->updateEvent($eventId, $eventData);
            return $result ? "Event updated successfully." : "Failed to update event.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Register a volunteer to an event
    public function registerVolunteer($eventId, $volunteerId) {
        try {
            $eventData = $this->eventModel->getEventById($eventId);
            if (!$eventData) {
                return "Error: Event not found.";
            }
    
            $eventObj = new Event($eventData); // Event object with state management
            $stateMessage = $eventObj->registerVolunteer($volunteerId);
    
            if (strpos($stateMessage, 'has been registered') !== false) {
                // Check if the volunteer exists in the Attendee table
                $attendeeCheckQuery = "SELECT attendee_id FROM Attendee WHERE attendee_id = :volunteer_id";
                $attendeeCheckResult = $this->db->query($attendeeCheckQuery, [':volunteer_id' => $volunteerId]);
    
                // Insert if not already present
                if (empty($attendeeCheckResult)) {
                    $this->db->execute(
                        "INSERT INTO Attendee (attendee_id, ticket_status) VALUES (:volunteer_id, 1)",
                        [':volunteer_id' => $volunteerId]
                    );
                }
    
                // Add the volunteer to the event
                $this->db->execute(
                    "INSERT INTO Event_Attendees (event_id, attendee_id) VALUES (:event_id, :volunteer_id)",
                    [':event_id' => $eventId, ':volunteer_id' => $volunteerId]
                );
    
                // Add volunteer as an observer
                $this->db->execute(
                    "INSERT INTO Event_Observers (event_id, user_id) VALUES (:event_id, :volunteer_id)",
                    [':event_id' => $eventId, ':volunteer_id' => $volunteerId]
                );
    
                // Send notification
                $this->sendNotification($volunteerId, "You are registered for Event ID: $eventId");
                return $stateMessage;
            } else {
                return $stateMessage;
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
     

    // Unregister a volunteer from an event
    public function unregisterVolunteer($eventId, $volunteerId) {
        try {
            // Remove volunteer from Event_Attendees
            $this->db->execute(
                "DELETE FROM Event_Attendees WHERE event_id = :event_id AND attendee_id = :volunteer_id",
                [':event_id' => $eventId, ':volunteer_id' => $volunteerId]
            );

            // Remove volunteer as an observer
            $this->db->execute(
                "DELETE FROM Event_Observers WHERE event_id = :event_id AND user_id = :volunteer_id",
                [':event_id' => $eventId, ':volunteer_id' => $volunteerId]
            );

            // Send notification
            $this->sendNotification($volunteerId, "You have been unregistered from Event ID: $eventId");

            return "Volunteer unregistered successfully.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // List event attendees
    public function listEventAttendees($eventId) {
        try {
            $query = "SELECT Volunteer.name, Volunteer.contact_info 
                      FROM Event_Attendees
                      JOIN Volunteer ON Volunteer.volunteer_id = Event_Attendees.attendee_id
                      WHERE Event_Attendees.event_id = :event_id";
            return $this->db->query($query, [':event_id' => $eventId]);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // List event volunteers
    public function listEventVolunteers($eventId) {
        $query = "SELECT v.volunteer_id, v.name, v.contact_info 
                  FROM Volunteer v
                  JOIN Event_Attendees ea ON ea.attendee_id = v.volunteer_id
                  WHERE ea.event_id = :event_id";
        return $this->db->query($query, [':event_id' => $eventId]);
    }    

    // Send notification to a user
    private function sendNotification($userId, $message) {
        $this->db->execute(
            "INSERT INTO Inbox (user_id, message) VALUES (:user_id, :message)",
            [':user_id' => $userId, ':message' => $message]
        );
    }

    // Get event details
    /*public function getEventDetails($eventId) {
        return $this->eventModel->getEventById($eventId);
    }*/
    public function generateReport($eventId) {
        $queryVolunteers = "SELECT COUNT(*) AS total_volunteers FROM Event_Attendees WHERE event_id = :event_id";
        $queryDonations = "SELECT SUM(amount) AS total_donations FROM Donation WHERE event_id = :event_id";

        $volunteers = $this->db->query($queryVolunteers, [':event_id' => $eventId]);
        $donations = $this->db->query($queryDonations, [':event_id' => $eventId]);

        return [
            'total_volunteers' => $volunteers[0]['total_volunteers'] ?? 0,
            'total_donations' => $donations[0]['total_donations'] ?? 0.00
        ];
    }

    public function getEventDetails($eventId) {
        $query = "SELECT * FROM Event WHERE event_id = :event_id";
        $result = $this->db->query($query, [':event_id' => $eventId]);

        return $result[0] ?? null;
    }

    // List all events
    public function listAllEvents() {
        return $this->eventModel->getEvents();
    }
}
