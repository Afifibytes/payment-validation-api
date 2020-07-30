<?php

namespace App\APIHandler\Response;

use App\PaymentsValidator\ValidationResponse;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var ValidationResponse
     */
    protected $validationResponse;


    /**
     * @return ValidationResponse
     */
    public function getValidationResponse(): ValidationResponse
    {
        return $this->validationResponse;
    }
}