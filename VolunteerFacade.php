<?php
require_once 'models/Volunteer.php';

class VolunteerFacade {
    private $volunteerModel;
    private $db;

    public function __construct() {
        $this->volunteerModel = new Volunteer();
        $this->db = Database::getInstance();
    }

    public function addVolunteer($data) {
        $isValid = $this->validateVolunteerData($data);
        if (!$isValid) {
            return ['success' => false, 'message' => 'Invalid volunteer data.'];
        }

        $result = $this->volunteerModel->addVolunteer($data);
        return $result
            ? ['success' => true, 'message' => 'Volunteer added successfully.']
            : ['success' => false, 'message' => 'Failed to add volunteer.'];
    }

    public function getVolunteer($volunteerId) {
        return $this->volunteerModel->getVolunteerByUserId($volunteerId);
    }

    public function updateVolunteer($volunteerId, $data) {
        $data[':volunteer_id'] = $volunteerId;
        $result = $this->volunteerModel->updateVolunteer($data);
        return $result
            ? ['success' => true, 'message' => 'Volunteer updated successfully.']
            : ['success' => false, 'message' => 'Failed to update volunteer.'];
    }

    public function listVolunteers() {
        $query = "
            SELECT 
                v.volunteer_id, 
                v.name, 
                v.contact_info, 
                GROUP_CONCAT(t.description SEPARATOR ', ') AS assigned_tasks
            FROM Volunteer v
            LEFT JOIN VolunteerTask_Volunteers vt ON v.volunteer_id = vt.volunteer_id
            LEFT JOIN VolunteerTask t ON vt.task_id = t.task_id
            GROUP BY v.volunteer_id
        ";
        return $this->db->query($query);
    }

    public function getInbox() {
        $userId = $_SESSION['user_id'];
        $query = "SELECT * FROM Inbox WHERE user_id = :user_id ORDER BY timestamp DESC";
        return $this->db->query($query, [':user_id' => $userId]);
    }

    public function getVolunteerSkills() {
        $volunteer = $this->volunteerModel->getVolunteerByUserId($_SESSION['user_id']);
        return $volunteer ? (new SkillDecorator($volunteer))->getSkills() : [];
    }

    public function getSkillsForSelection() {
        $volunteer = $this->volunteerModel->getVolunteerByUserId($_SESSION['user_id']);
        if (!$volunteer) {
            return ['error' => true, 'message' => 'Volunteer not found.'];
        }

        $skills = $this->db->query("SELECT * FROM Skill");
        return [
            'error' => false,
            'skills' => $skills,
            'volunteerSkills' => $volunteer->getSkillIds()
        ];
    }

    public function assignSkills() {
        $volunteer = $this->volunteerModel->getVolunteerByUserId($_SESSION['user_id']);
        if (!$volunteer) {
            return ['success' => false, 'message' => 'Volunteer not found.'];
        }

        $selectedSkills = $_POST['skills'] ?? [];
        $validSkills = array_column($this->db->query("SELECT skill_id FROM Skill"), 'skill_id');
        $validSelectedSkills = array_intersect($selectedSkills, $validSkills);

        $this->db->execute("DELETE FROM Volunteer_Skills WHERE volunteer_id = :volunteer_id", [
            ':volunteer_id' => $volunteer->volunteer_id
        ]);

        foreach ($validSelectedSkills as $skillId) {
            $this->db->execute("INSERT INTO Volunteer_Skills (volunteer_id, skill_id) VALUES (:volunteer_id, :skill_id)", [
                ':volunteer_id' => $volunteer->volunteer_id,
                ':skill_id' => $skillId
            ]);
        }

        return ['success' => true, 'message' => 'Skills updated successfully.'];
    }

    public function getTasksForAssignment($eventId) {
        if (!$eventId) {
            return ['error' => true, 'message' => 'Event ID is required.'];
        }

        $volunteers = $this->db->query(
            "SELECT v.volunteer_id, v.name, v.contact_info FROM Volunteer v
            JOIN Event_Attendees ea ON v.volunteer_id = ea.attendee_id WHERE ea.event_id = :event_id",
            [':event_id' => $eventId]
        );

        $tasks = $this->db->query("SELECT * FROM VolunteerTask");
        return ['error' => false, 'volunteers' => $volunteers, 'tasks' => $tasks];
    }

    public function saveAssignedTasks($params) {
        if (!isset($params['event_id'], $params['volunteers'], $params['tasks'])) {
            return ['success' => false, 'message' => 'Missing required parameters.'];
        }

        foreach ($params['volunteers'] as $volunteerId => $taskId) {
            $this->db->execute(
                "INSERT INTO VolunteerTask_Volunteers (task_id, volunteer_id) VALUES (:task_id, :volunteer_id)",
                [':task_id' => $taskId, ':volunteer_id' => $volunteerId]
            );
        }

        return ['success' => true, 'message' => 'Tasks assigned successfully.'];
    }

    private function validateVolunteerData($data) {
        return isset($data[':volunteer_id'], $data[':name'], $data[':contact_info']);
    }
}


?>
