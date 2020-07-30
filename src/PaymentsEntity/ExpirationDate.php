<?php


namespace App\PaymentsEntity;

class ExpirationDate
{
    /**
     * @var string
     */
    private $expirationMonth;

    /**
     * @var string
     */
    private $expirationYear;

    /**
     * ExpirationDate constructor.
     * @param string $expirationMonth
     * @param string $expirationYear
     */
    public function __construct(string $expirationMonth, string $expirationYear)
    {
        $this->expirationMonth = $expirationMonth;
        $this->expirationYear = $expirationYear;
    }

    /**
     * @return string
     */
    public function getExpirationMonth(): string
    {
        return $this->expirationMonth;
    }

    /**
     * @param string $expirationMonth
     */
    public function setExpirationMonth(string $expirationMonth): void
    {
        $this->expirationMonth = $expirationMonth;
    }

    /**
     * @return string
     */
    public function getExpirationYear(): string
    {
        return $this->expirationYear;
    }

    /**
     * @param string $expirationYear
     */
    public function setExpirationYear(string $expirationYear): void
    {
        $this->expirationYear = $expirationYear;
    }



}