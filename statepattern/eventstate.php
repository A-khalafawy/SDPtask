<?php
interface EventState {
    public function registerVolunteer(Event $event, int $volunteerId): string;
    public function viewDetails(Event $event): string;
}
?>