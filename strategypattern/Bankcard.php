<?php
require_once  __DIR__ .'/../proxypattern/BankGatewayProxy.php';
#require_once '../proxypattern/BankGatewayProxy.php';
#require_once '../proxypattern/IBankGateway.php';
require_once  __DIR__ .'/../proxypattern/IBankGateway.php';
require_once 'IPaymentMethod.php';


class BankCard implements IPaymentMethod {
    private string $cardNumber;
    private string $cvv;
    private string $expiryDate;
    private IBankGateway $bankGateway;

    public function __construct(string $cardNumber, string $cvv, string $expiryDate) {
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->expiryDate = $expiryDate;
        $this->bankGateway = new BankGatewayProxy();
    }

    public function processPayment($amount): bool {
        return $this->bankGateway->validatePayment($amount, $this->cardNumber, $this->expiryDate, $this->cvv);
    }
}
?>
