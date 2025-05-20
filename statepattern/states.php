<?php
require_once 'eventstate.php'; // So the interface is recognized

class UpcomingState implements EventState {
    public function registerVolunteer(Event $event, int $volunteerId): string {
        // Logic for registering a volunteer
        return "Volunteer $volunteerId has been registered for the event.";
    }

    public function viewDetails(Event $event): string {
        return "The event '{$event->getName()}' is open for registration.";
    }
}

class OngoingState implements EventState {
    public function registerVolunteer(Event $event, int $volunteerId): string {
        // Logic when the event is ongoing (no new registrations)
        return "Registration is closed as the event is ongoing.";
    }

    public function viewDetails(Event $event): string {
        return "The event '{$event->getName()}' is currently happening.";
    }
}

class CompletedState implements EventState {
    public function registerVolunteer(Event $event, int $volunteerId): string {
        // Logic when the event has concluded
        return "Registration is closed as the event has concluded.";
    }

    public function viewDetails(Event $event): string {
        return "The event '{$event->getName()}' has concluded.";
    }
}
