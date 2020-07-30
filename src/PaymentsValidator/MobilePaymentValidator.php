<?php

namespace App\PaymentsValidator;

use App\PaymentsEntity\MobileNumber;

/**
 * Note: This validator checks mobile numbers for US only.
 *
 * Class MobilePaymentValidator
 * @package App\PaymentsValidator
 */
class MobilePaymentValidator implements PaymentValidatorInterface
{
    /**
     * @var MobileNumber
     */
    private $mobileNumber;

    /**
     * MobilePaymentValidator constructor.
     * @param MobileNumber $mobileNumber
     */
    public function __construct(MobileNumber $mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * Simple function to validate payment method date.
     *
     * @return ValidationResponse
     */
    public function validate(): ValidationResponse
    {
        if (!$this->isValidUSCountryCode()) {
            return new ValidationResponse(false, "Invalid US Code!");
        }
        if (!$this->isValidNumber()) {
            return new ValidationResponse(false, "Mobile Number is Invalid!");
        }

        return new ValidationResponse(true, "Successful Transaction!");
    }

    /**
     * @return bool
     */
    private function isValidUSCountryCode(): bool
    {
        $countryCode = $this->mobileNumber->getCountryCode();
        if ($countryCode !== "+1") {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    private function isValidNumber(): bool
    {
        $number = $this->mobileNumber->getNumber();
        $numberDigits = preg_match_all("/[0-9]/", $number);
        if (!ctype_digit($number) || $numberDigits !== 9) {
            return false;
        }
        return true;
    }

}