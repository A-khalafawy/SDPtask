<?php
require_once 'IPaymentMethod.php';

class EWallet implements IPaymentMethod {
    protected string $email;
    protected string $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function processPayment($amount): bool {
        // Simulate processing payment using an EWallet API
        // TODO: Replace this with actual EWallet API logic
        if ($amount > 0) {
            return true;
        }
        return false;
    }
}
?>
