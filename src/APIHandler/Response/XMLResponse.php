<?php

namespace App\APIHandler\Response;

use App\PaymentsValidator\ValidationResponse;

class XMLResponse extends AbstractResponse
{

    /**
     * XMLResponse constructor.
     * @param ValidationResponse $validationResponse
     */
    public function __construct(ValidationResponse $validationResponse)
    {
        $this->validationResponse = $validationResponse;
    }

    public function format()
    {
        $isValid = $this->validationResponse->isValid() ? "true" : "false";
        $message = $this->validationResponse->getValidationMessage();
        return "<valid>$isValid</valid><message>$message</message>";
    }
}