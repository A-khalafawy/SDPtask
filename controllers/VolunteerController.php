<?php
require_once 'models/Volunteer.php';
require_once __DIR__ . '/../VolunteerDecorators.php';
require_once 'VolunteerFacade.php';

class VolunteerController {
    private $volunteerFacade;

    public function __construct() {
        // Initialize the VolunteerFacade
        $this->volunteerFacade = new VolunteerFacade();
    }

    // Adds a new volunteer
    public function addVolunteer($data) {
        $result = $this->volunteerFacade->addVolunteer($data);

        if ($result['success']) {
            echo "Volunteer added successfully.";
        } else {
            echo "Error adding volunteer: " . $result['message'];
        }
    }

    // Retrieves volunteer information
    public function getVolunteer($volunteerId) {
        $volunteer = $this->volunteerFacade->getVolunteer($volunteerId);
        require 'views/volunteer/view.php';
    }

    // Updates a volunteer’s details
    public function updateVolunteer($volunteerId, $data) {
        $result = $this->volunteerFacade->updateVolunteer($volunteerId, $data);
        echo $result ? "Volunteer updated successfully." : "Error updating volunteer.";
    }

    public function viewInbox() {
        $notifications = $this->volunteerFacade->getInbox();
        include 'views/inbox.php';
    }

    public function listVolunteers() {
        $volunteers = $this->volunteerFacade->listVolunteers();
        require 'views/volunteer/list.php';
    }

    // Displays logged-in volunteer's skills
    public function viewSkills() {
        $skills = $this->volunteerFacade->getVolunteerSkills();
        include 'views/volunteer/view_skills.php';
    }

    // Displays the choose_skills.php view
    public function chooseSkills() {
        $data = $this->volunteerFacade->getSkillsForSelection();
        if ($data['error']) {
            echo "Error: " . $data['message'];
        } else {
            $skills = $data['skills'];
            $volunteerSkills = $data['volunteerSkills'];
            include 'views/volunteer/choose_skills.php';
        }
    }

    // Assign skills to the logged-in volunteer
    public function assignSkills() {
        $result = $this->volunteerFacade->assignSkills();
        if ($result['success']) {
            echo "Skills updated successfully.";
            header("Location: index.php?controller=volunteer&action=viewSkills");
            exit;
        } else {
            echo "Error: " . $result['message'];
        }
    }

    public function assignTasks($params) {
        $data = $this->volunteerFacade->getTasksForAssignment($params['event_id'] ?? null);
        if ($data['error']) {
            echo "Error: " . $data['message'];
        } else {
            $volunteers = $data['volunteers'];
            $tasks = $data['tasks'];
            include 'views/volunteer/assign_tasks.php';
        }
    }

    public function saveAssignedTasks($params) {
        $result = $this->volunteerFacade->saveAssignedTasks($params);
        if ($result['success']) {
            echo "Tasks assigned successfully.";
            header("Location: index.php?controller=volunteer&action=listVolunteers");
            exit;
        } else {
            echo "Error: " . $result['message'];
        }
    }
}
?>
