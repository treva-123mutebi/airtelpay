<?php
include 'vendor/autoload.php';
function generateRandomString($length = 10) {
   return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
};
$credentials=$_REQUEST['credentials'];
$headers = array(
    'Content-Type' => 'application/json',
    'X-Country' => 'UG',
    'X-Currency' => 'UGX',
    'Authorization'  => $credentials,
);
$client = new GuzzleHttp\Client();
// Define array of request body. 
$request_body = array(
    
   "reference" => "Testing transaction", 
   "subscriber" => [
         "country" => "UG", 
         "currency" => "UGX", 
         "msisdn" => 700701381
      ], 
   "transaction" => [
            "amount" => 500, 
            "country" => "UG", 
            "currency" => "UGX",
            "id" => generateRandomString() 
        

 
 
   ]);
try {
    $response = $client->request('POST','https://openapi.airtel.africa/merchant/v1/payments/', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (GuzzleHttpExceptionBadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }
 // ...