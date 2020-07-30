<?php

namespace App\APIHandler\Response;

use App\PaymentsValidator\ValidationResponse;

class JsonResponse extends AbstractResponse
{

    /**
     * JsonResponse constructor.
     * @param ValidationResponse $validationResponse
     */
    public function __construct(ValidationResponse $validationResponse)
    {
        $this->validationResponse = $validationResponse;
    }

    /**
     * @return string
     */
    public function format(): ?string
    {
        return json_encode($this->validationResponse);
    }
}