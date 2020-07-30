<?php

namespace App\APIHandler;

use App\APIHandler\Response\JsonResponse;
use App\APIHandler\Response\ResponseInterface;
use App\APIHandler\Response\XMLResponse;
use App\PaymentsEntity\PaymentMethodFactory;
use App\PaymentsEntity\Transaction;
use App\PaymentsValidator\PaymentsValidatorsFactory;
use App\PaymentsValidator\ValidationResponse;
use Exception;

class RequestHandler
{
    /**
     * @param array $data
     * @return ResponseInterface
     */
    public static function handleRequest(array $data): ResponseInterface
    {
        if (!$data["paymentParameters"] || !$data["key"])
            return new JsonResponse(new ValidationResponse(false, "Missing key or paymentParameters!"));

        try {
            $paymentMethod = PaymentMethodFactory::create($data["paymentParameters"]);
            $validator = PaymentsValidatorsFactory::create($paymentMethod);
            $validationResponse = $validator->validate();
        } catch (Exception $exception) {
            $validationResponse = new ValidationResponse(false, $exception->getMessage());
        }
        if ($validationResponse->isValid()) {
            $requestHash = hash_hmac('sha256', microtime(true) . $data, $data["key"]);
            $transaction = new Transaction();
            $transaction->setHash($requestHash);
            $transaction->save();
        }
        if ($data["xml"]) {
            return new XMLResponse($validationResponse);
        }
        return new JsonResponse($validationResponse);
    }
}