<?php
require_once 'IBankGateway.php';
require_once 'RealBankGateway.php';
require_once 'UserContext.php';

class BankGatewayProxy implements IBankGateway {
    private ?RealBankGateway $realBankGateway = null;
    private UserContext $userContext;
    private array $requestLog = [];

    public function __construct(UserContext $context) {
        $this->userContext = $context;
    }

    public function validatePayment(float $amount, string $cardNumber, string $expiryDate, string $cvv): bool {
        // Access control (Protective Proxy)
        if (!$this->userContext->hasPermission('PAYMENT')) {
            throw new Exception("Access Denied: User role '{$this->userContext->getRole()}' is not allowed to make payments.");
        }

        // Lazy-load RealBankGateway (Virtual Proxy)
        if ($this->realBankGateway === null) {
            $this->realBankGateway = new RealBankGateway();
        }

        $this->logRequest($cardNumber);

        if ($this->isRateLimited($cardNumber)) {
            error_log("Payment BLOCKED: Too many attempts for card ending in " . substr($cardNumber, -4));
            return false;
        }

        $isValid = $this->realBankGateway->validatePayment($amount, $cardNumber, $expiryDate, $cvv);
        $this->logPaymentResult($isValid, $cardNumber);
        return $isValid;
    }

    private function logRequest(string $cardNumber): void {
        $lastFour = substr($cardNumber, -4);
        $now = time();
        $this->requestLog[$lastFour][] = $now;

        // Keep only recent requests (60 seconds)
        $this->requestLog[$lastFour] = array_filter(
            $this->requestLog[$lastFour],
            fn($timestamp) => ($now - $timestamp) < 60
        );
    }

    private function isRateLimited(string $cardNumber): bool {
        $lastFour = substr($cardNumber, -4);
        return count($this->requestLog[$lastFour] ?? []) > 3;
    }

    private function logPaymentResult(bool $isValid, string $cardNumber): void {
        $status = $isValid ? 'SUCCESS' : 'FAILURE';
        error_log("Payment $status for card ending in " . substr($cardNumber, -4));
    }
}

?>