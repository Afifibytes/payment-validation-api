<?php

namespace App\PaymentsEntity;

class MobileNumber implements PaymentMethodInterface
{
    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $number;

    /**
     * MobileNumber constructor.
     * @param string $countryCode
     * @param string $number
     */
    public function __construct(string $countryCode, string $number)
    {
        $this->countryCode = $countryCode;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }


}