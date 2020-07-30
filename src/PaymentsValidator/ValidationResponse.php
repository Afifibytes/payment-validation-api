<?php


namespace App\PaymentsValidator;


class ValidationResponse
{
    /**
     * @var bool
     */
    public $valid;

    /**
     * @var string
     */
    public $validationMessage;

    /**
     * ValidationResponse constructor.
     * @param bool $valid
     * @param string $validationMessage
     */
    public function __construct(bool $valid, string $validationMessage)
    {
        $this->valid = $valid;
        $this->validationMessage = $validationMessage;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @return string
     */
    public function getValidationMessage(): string
    {
        return $this->validationMessage;
    }

}