<?php
require_once 'Command.php';

class CommandInvoker {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function executeCommand() {
        $this->command->execute();
    }

    public function undoCommand() {
        $this->command->undo();
    }
}
