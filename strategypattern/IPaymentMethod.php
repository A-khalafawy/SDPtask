<?php
interface IPaymentMethod {
    public function processPayment(float $amount): bool;
}
?>
