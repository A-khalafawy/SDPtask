<?php

class EventAttendeeIterator implements \Iterator 
{
    private array $attendees; // List of attendees
    private int $position = 0; // Current position

    public function __construct(array $attendees) {
        $this->attendees = $attendees;
        $this->position = 0;
    }

    public function current(): mixed {
        return $this->attendees[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        $this->position++;
    }

    public function valid(): bool {
        return isset($this->attendees[$this->position]);
    }

    public function rewind(): void {
        $this->position = 0;
    }
}
?>
