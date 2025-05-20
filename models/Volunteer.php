<?php
require_once 'Observer.php';
require_once 'Event.php';
require_once 'config/Database.php';
class Volunteer implements Observer {
    private $db;

    public $volunteer_id;
    public $name;
    public $contact_info;
    public $availability;
    public $user_id;

    public function __construct() {
        // Use the Singleton Database instance
        $this->db = Database::getInstance();
    }

    public function update($eventData) {
        $message = "Event '{$eventData['name']}' has been updated. Check the details!";
        $query = "INSERT INTO Inbox (user_id, message) VALUES (:user_id, :message)";
        $this->db->execute($query, [
            ':user_id' => $this->user_id,
            ':message' => $message,
        ]);
    }

    public function getNotifications() {
        $query = "SELECT * FROM Inbox WHERE user_id = :user_id ORDER BY timestamp DESC";
        return $this->db->query($query, [':user_id' => $this->user_id]);
    }
    
    


    public function getVolunteerByUserId($userId) {
        $query = "SELECT * FROM Volunteer WHERE user_id = :user_id";
        $result = $this->db->query($query, [':user_id' => $userId]);
    
        if (count($result) === 0) {
            return null; // No volunteer found
        }
    
        // Populate the current Volunteer object instead of creating a new one
        $this->volunteer_id = $result[0]['volunteer_id'];
        $this->name = $result[0]['name'];
        $this->contact_info = $result[0]['contact_info'];
        //$this->availability = $result[0]['availability'];
        $this->user_id = $result[0]['user_id'];
    
        return $this;
    }
    
    
    
    

    // Get all volunteers
    public function getVolunteers() {
        $query = "SELECT * FROM Volunteer"; 
        return $this->db->query($query);
    }


    public function getSkillIds() {
        $query = "SELECT skill_id FROM Volunteer_Skills WHERE volunteer_id = :volunteer_id";
        $result = $this->db->query($query, [':volunteer_id' => $this->volunteer_id]);
    
        if (empty($result)) {
            return []; // Return an empty array if no skills found
        }
    
        return array_column($result, 'skill_id');
    }
    
    

   

       
    
    // Add a new volunteer
    public function addVolunteer($volunteerData) {
        $query = "INSERT INTO Volunteer (volunteer_id, name, contact_info) 
                  VALUES (:volunteer_id, :name, :contact_info)";
        return $this->db->execute($query, $volunteerData);
    }

    // Update volunteer details
    public function updateVolunteer($volunteerData) {
        $query = "UPDATE Volunteer SET name = :name, contact_info = :contact_info
                  WHERE volunteer_id = :volunteer_id";
        return $this->db->execute($query, $volunteerData);
    }

    // Delete a volunteer
    public function deleteVolunteer($volunteerId) {
        $query = "DELETE FROM Volunteer WHERE volunteer_id = :volunteer_id";
        return $this->db->execute($query, [':volunteer_id' => $volunteerId]);
    }
}
?>
