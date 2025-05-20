<?php
require_once 'IEmailer.php';
require_once 'LegacyEmailer.php';

class EmailAdapter implements IEmailer {
    private $legacyEmailer;

    public function __construct(LegacyEmailer $legacyEmailer) {
        $this->legacyEmailer = $legacyEmailer;
    }

    public function sendMessage(int $userId,string $recipient, string $subject, string $body): void {
        $this->legacyEmailer->sendMail($recipient, $subject, $body);
        $fullMessage = "Subject: {$subject}\n{$body}";
        $db = Database::getInstance();
        $db->execute(
            "INSERT INTO Inbox (user_id, message, timestamp) 
             VALUES (:uid, :msg, NOW())",
            [
                ':uid' => $userId,
                ':msg' => $fullMessage
            ]
        );

        echo "[ADAPTER] Also stored the message in the Inbox table for user_id=$userId.\n";
    }
    
}
?>
