<?php
require_once 'models/Event.php';
require_once 'models/Volunteer.php';
require_once 'models/Donor.php';
require_once __DIR__ . '/../commands/RegisterVolunteerCommand.php';
require_once __DIR__ . '/../commands/CommandInvoker.php';
require_once __DIR__ . '/../EventManagementFacade.php';

class EventController {
    private $eventFacade;

    public function __construct() {
        $this->eventFacade = new EventManagementFacade();
    }

    public function store() {
        $eventData = [
            'name' => $_POST['name'],
            'date' => $_POST['date'],
            'location' => $_POST['location'],
            'capacity' => $_POST['capacity']
        ];

        $result = $this->eventFacade->createEvent($eventData);
        if ($result) {
            header("Location: index.php?controller=event&action=list");
            exit;
        } else {
            echo "Error creating event.";
        }
    }

    public function view($params) {
        $eventId = $params['id'] ?? null;
        if (!$eventId) {
            echo "Error: Event ID is required.";
            return;
        }

        $event = $this->eventFacade->getEventDetails($eventId);
        include 'views/event/view.php';
    }

    public function update($params) {
        $eventId = $params['id'] ?? null;
        unset($params['id']); // Remove `id` from data
        $data = $params;

        if (!$eventId || empty($data)) {
            echo "Invalid event ID or data.";
            return;
        }

        $result = $this->eventFacade->updateEvent($eventId, $data);
        if ($result) {
            header("Location: index.php?controller=event&action=list");
            exit;
        } else {
            echo "Error updating event.";
        }
    }

    public function list() {
        $events = $this->eventFacade->listAllEvents();

        if ($_SESSION['role'] === 'Donor') {
            include 'views/event/donor_list.php'; // Separate view for donors
        } elseif ($_SESSION['role'] === 'Volunteer') {
            include 'views/event/volunteer_list.php'; // New view for volunteers
        } else {
            include 'views/event/list.php'; // Existing view for admins
        }
    }

    public function add() {
        include 'views/event/add.php';
    }

    public function edit($params) {
        $eventId = $params['id'] ?? null;
        if (!$eventId) {
            echo "Error: Event ID is required.";
            return;
        }

        $event = $this->eventFacade->getEventDetails($eventId);
        include 'views/event/edit.php';
    }

    public function register($params) {
    $eventId = $params['event_id'] ?? null;
    $volunteerId = $_SESSION['user_id'];
    if (!$eventId || !$volunteerId) {
        echo "Error: Missing event or volunteer ID.";
        return;
    }
    $command = new RegisterVolunteerCommand($eventId, $volunteerId);
    $invoker = new CommandInvoker();
    $invoker->setCommand($command);
    $invoker->executeCommand();
}

    

    public function unregister($params) {
    $eventId = $params['event_id'] ?? null;
    $volunteerId = $_SESSION['user_id'];

    if (!$eventId || !$volunteerId) {
        echo "Error: Missing event or volunteer ID.";
        return;
    }

    $command = new RegisterVolunteerCommand($eventId, $volunteerId);
    $invoker = new CommandInvoker();
    $invoker->setCommand($command);

    
    $invoker->undoCommand();
}


    public function listAttendees($params) {
        $eventId = $params['event_id'] ?? null;

        if (!$eventId) {
            echo "Error: Event ID is missing.";
            return;
        }

        $attendees = $this->eventFacade->listEventAttendees($eventId);
        include 'views/event/attendees.php';
    }

    public function listVolunteers($params) {
        $eventId = $params['event_id'] ?? null;

        if (!$eventId) {
            echo "Error: Event ID is missing.";
            return;
        }

        $volunteers = $this->eventFacade->listEventVolunteers($eventId);
        include 'views/event/volunteer_attendees.php';
    }
}

