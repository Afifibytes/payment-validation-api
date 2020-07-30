<?php

require __DIR__.'/vendor/autoload.php';

use App\APIHandler\RequestHandler;

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    return http_response_code(405);

$data    = trim(file_get_contents('php://input'));
$xmlData = simplexml_load_string($data);
$isXML = $xmlData ? true : false;
if ($isXML) {
    header('Content-Type: application/xml');
    $data = json_encode($xmlData);
}
$dataArray = json_decode($data, true);
$dataArray["xml"] = $isXML;
$response = RequestHandler::handleRequest($dataArray);
echo $response->format();

if (!$response->getValidationResponse()->isValid())
    return http_response_code(400);