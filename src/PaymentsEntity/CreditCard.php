<?php


namespace App\PaymentsEntity;

class CreditCard implements PaymentMethodInterface
{

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var ExpirationDate
     */
    private $expirationDate;

    /**
     * @var string
     */
    private $cvv;

    /**
     * @var string
     */
    private $email;

    /**
     * CreditCard constructor.
     * @param ExpirationDate $expirationDate
     * @param string $cardNumber
     * @param string $cvv
     * @param string $email
     */
    public function __construct(ExpirationDate $expirationDate, string $cardNumber, string $cvv, string $email)
    {
        $this->expirationDate = $expirationDate;
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->email = $email;
    }


    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return ExpirationDate
     */
    public function getExpirationDate(): ExpirationDate
    {
        return $this->expirationDate;
    }

    /**
     * @param ExpirationDate $expirationDate
     */
    public function setExpirationDate(ExpirationDate $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     */
    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}