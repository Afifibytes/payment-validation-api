<?php


namespace App\PaymentsValidator;

use App\PaymentsEntity\PaymentMethodInterface;
use Exception;
use App\PaymentsEntity\CreditCard;
use App\PaymentsEntity\MobileNumber;

class PaymentsValidatorsFactory
{
    /**
     * @param PaymentMethodInterface $paymentMethod
     * @return PaymentValidatorInterface
     * @throws Exception
     */
    public static function create(PaymentMethodInterface $paymentMethod): PaymentValidatorInterface
    {
        if ($paymentMethod instanceof CreditCard) {
            return new CreditCardPaymentValidator($paymentMethod);
        }
        elseif ($paymentMethod instanceof MobileNumber) {
            return new MobilePaymentValidator($paymentMethod);
        }
        else {
            throw new Exception("Validator Not Found!");
        }
    }
}