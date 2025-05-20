<?php
require_once 'IBankGateway.php';
require_once 'RealBankGateway.php';
class BankGatewayProxy implements IBankGateway {
    private RealBankGateway $realBankGateway;

    public function __construct() {
        $this->realBankGateway = new RealBankGateway();
    }

    public function validatePayment(float $amount, string $cardNumber, string $expiryDate, string $cvv): bool {
        // Proxy logic: e.g., logging
        $this->logPaymentAttempt($amount, $cardNumber, $expiryDate);

        // Forward the request to the real bank gateway
        $isValid = $this->realBankGateway->validatePayment($amount, $cardNumber, $expiryDate, $cvv);

        // Proxy logic: e.g., logging result
        $this->logPaymentResult($isValid);

        return $isValid;
    }

    private function logPaymentAttempt(float $amount, string $cardNumber, string $expiryDate): void {
        // Log the payment attempt
        error_log("Attempting payment: Amount: $amount, Card: " . substr($cardNumber, -4) . ", Expiry: $expiryDate");
    }

    private function logPaymentResult(bool $isValid): void {
        // Log the payment result
        $result = $isValid ? 'successful' : 'failed';
        error_log("Payment was $result.");
    }
}
?>
