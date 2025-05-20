<?php
interface IBankGateway {
    public function validatePayment(float $amount, string $cardNumber, string $expiryDate, string $cvv): bool;
}
?>
