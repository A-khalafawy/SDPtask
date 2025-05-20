<?php
interface IEmailer {
    public function sendMessage(int $userId,string $recipient, string $subject, string $body): void;
}
?>
