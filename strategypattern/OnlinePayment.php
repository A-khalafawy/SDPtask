<?php
require_once 'IPaymentMethod.php';
class OnlinePayment {
    private IPaymentMethod $paymentMethod;

    public function __construct(IPaymentMethod $paymentMethod) {
        $this->paymentMethod = $paymentMethod;
    }

    public function process(float $amount): bool {
        return $this->paymentMethod->processPayment($amount);
    }
}
?>
