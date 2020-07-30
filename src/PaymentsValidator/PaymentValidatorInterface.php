<?php

namespace App\PaymentsValidator;

interface PaymentValidatorInterface
{
    /**
     * Simple function to validate payment method date.
     *
     * @return ValidationResponse
     */
    public function validate(): ValidationResponse;
}