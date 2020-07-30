<?php

namespace App\PaymentsValidator;

use DateTime;
use App\PaymentsEntity\CreditCard;

/**
 * Class CreditCardPaymentValidator
 * @package App\PaymentsValidator
 */
class CreditCardPaymentValidator implements PaymentValidatorInterface
{

    /**
     * @var CreditCard
     */
    private $creditCard;

    /**
     * CreditCardPaymentValidator constructor.
     * @param CreditCard $creditCard
     */
    public function __construct(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * Simple function to validate payment method date.
     *
     * @return ValidationResponse
     */
    public function validate(): ValidationResponse
    {
        if ($this->isExpired()) {
            return new ValidationResponse(false, "Credit Card is Expired!");
        }
        if (!$this->isValidEmail()) {
            return new ValidationResponse(false, "Email is Not Valid!");
        }
        if (!$this->isValidNumber()) {
            return new ValidationResponse(false, "Error Processing Card Number!");
        }
        if (!$this->isValidCVV()) {
            return new ValidationResponse(false, "Error Processing CVV Number!");
        }

        return new ValidationResponse(true, "Successful Transaction!");
    }


    /**
     * Simple function to validate credit card's number pattern
     * Using Luhn's algorithm
     *
     * @return bool
     */
    private function isValidNumber(): bool
    {
        $cardNumber = $this->creditCard->getCardNumber();
        if (!ctype_digit($cardNumber) || preg_match_all("/[0-9]/", $cardNumber) > 19) {
            return false;
        }


        $sum = 0;
        $count = 0;
        $cardDigits = str_split($cardNumber);
        $flippedCardNumbers = array_reverse($cardDigits);
        foreach ($flippedCardNumbers as $digit) {
            $count++;
            if ($count % 2 !== 0) {
                $sum = $sum + $digit;
            } elseif ($digit < 5) {
                $sum = $sum + 2 * $digit;
            } else {
                $sum = $sum + 2 * $digit - 9;
            }
        }
        if ($sum % 10 !== 0) {
            return false;
        }

        return true;
    }

    /**
     * Simple function to validate cvv digits.
     * @return bool
     */
    private function isValidCVV(): bool
    {
        $cvv = $this->creditCard->getCvv();
        $cvvDigits = preg_match_all("/[0-9]/", $cvv);
        if (!ctype_digit($cvv) || $cvvDigits > 4 || $cvvDigits < 3) {
            return false;
        }

        return true;
    }

    /**
     * Simple function to check credit card expiration.
     *
     * @return bool
     */
    private function isExpired(): bool
    {
        $expirationMonth = $this->creditCard->getExpirationDate()->getExpirationMonth();
        $expirationYear  = $this->creditCard->getExpirationDate()->getExpirationYear();

        if (!ctype_digit($expirationMonth) ||
            !ctype_digit($expirationYear) ||
            $expirationMonth < 1 || $expirationMonth > 12 ||
            $expirationYear < 20 || $expirationYear > 99) {
            return true;
        }
        $cardDate = date_create_from_format('j-m-Y', "01-$expirationMonth-20$expirationYear");

        $now = new DateTime();
        if ($cardDate < $now) {
            return true;
        }

        return false;
    }

    /**
     * Simple function to validate email pattern.
     *
     * @return bool
     */
    private function isValidEmail(): bool
    {
        if(!filter_var($this->creditCard->getEmail(), FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}