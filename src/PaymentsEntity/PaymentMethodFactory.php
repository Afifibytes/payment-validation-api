<?php


namespace App\PaymentsEntity;

use Exception;

class PaymentMethodFactory
{
    /**
     * @param $data
     * @return PaymentMethodInterface
     * @throws Exception
     */
    public static function create($data): PaymentMethodInterface
    {
        if (self::isEmptyParameters($data)) {
            throw new Exception("Missing Payment Data!");
        }
        foreach ($data as $key => $value) {
            if ($key = "paymentMethod" && $value == "creditCard") {
                $expirationMonth = $data["expirationDate"]["month"];
                $expirationYear  = $data["expirationDate"]["year"];
                $expirationDate  = new ExpirationDate($expirationMonth, $expirationYear);
                return new CreditCard($expirationDate, $data["cardNumber"], $data["cvv"], $data["email"]);
            } elseif ($key = "paymentMethod" && $value == "mobileNumber") {
                return new MobileNumber($data["countryCode"], $data["number"]);
            }
        }

        throw new Exception("Payment Method Not Supported!");
    }

    /**
     * @param array $data
     * @return bool
     */
    private static function isEmptyParameters(array $data): bool
    {
        if ($data["paymentMethod"] == "creditCard"){
            if (!isset($data["expirationDate"]["year"]) ||
            !isset($data["expirationDate"]["month"]) ||
            !isset($data["cardNumber"]) ||
            !isset($data["cvv"]) ||
            !isset($data["email"])){
                return true;
            }
        }
        elseif ($data["paymentMethod"] == "mobileNumber") {
            if (!isset($data["countryCode"]) || !isset($data["number"])) {
                return true;
            }
        }

        return false;
    }
}