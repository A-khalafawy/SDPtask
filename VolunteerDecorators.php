<?php
// Decorator Abstract Class
abstract class VolunteerDecorator extends Volunteer {
    protected $volunteer;

    public function __construct(Volunteer $volunteer) {
        $this->volunteer = $volunteer;
    }

    public function getVolunteers() {
        return $this->volunteer->getVolunteers();
    }

    public function getVolunteerById($volunteerId) {
        return $this->volunteer->getVolunteerByUserId($volunteerId);
    }

    public function addVolunteer($volunteerData) {
        return $this->volunteer->addVolunteer($volunteerData);
    }

    public function updateVolunteer($volunteerData) {
        return $this->volunteer->updateVolunteer($volunteerData);
    }

    public function deleteVolunteer($volunteerId) {
        return $this->volunteer->deleteVolunteer($volunteerId);
    }

    public function update($eventData) {
        $this->volunteer->update($eventData);
    }
}

// Concrete Decorator Class
class SkillDecorator extends VolunteerDecorator {
    public function addSkill($skillId) {
        $query = "INSERT INTO Volunteer_Skills (volunteer_id, skill_id) VALUES (:volunteer_id, :skill_id)";
        $params = [
            ':volunteer_id' => $this->volunteer->volunteer_id,
            ':skill_id' => $skillId,
        ];
        Database::getInstance()->execute($query, $params);
    }

    public function removeSkill($skillId) {
        $query = "DELETE FROM Volunteer_Skills WHERE volunteer_id = :volunteer_id AND skill_id = :skill_id";
        $params = [
            ':volunteer_id' => $this->volunteer->volunteer_id,
            ':skill_id' => $skillId,
        ];
        Database::getInstance()->execute($query, $params);
    }

    public function getSkills() {
        $query = "SELECT s.skill_id, s.skill_name 
                  FROM Skill s
                  JOIN Volunteer_Skills vs ON s.skill_id = vs.skill_id
                  WHERE vs.volunteer_id = :volunteer_id";
        $params = [':volunteer_id' => $this->volunteer->volunteer_id];
        return Database::getInstance()->query($query, $params);
    }
    
    public function displaySkills() {
        $skills = $this->getSkills(); // Use the decorator's getSkills method
        $skillNames = array_column($skills, 'skill_name');
        echo "Skills: " . implode(", ", $skillNames) . "\n";
    }
    
    
}


?>
