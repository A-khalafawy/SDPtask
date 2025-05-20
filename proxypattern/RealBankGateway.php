<?php
require_once 'IBankGateway.php';
class RealBankGateway implements IBankGateway {
    public function validatePayment(float $amount, string $cardNumber, string $expiryDate, string $cvv): bool {
        // Simulate real bank gateway validation logic
        if ($amount > 0 && strlen($cardNumber) === 16 && strlen($cvv) === 3 && strtotime($expiryDate) > time()) {
            return true; // Payment validation successful
        }
        return false; // Payment validation failed
    }
}
?>
