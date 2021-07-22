<?php
session_start();
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
include 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

if (isset($_POST['submit'])) {
    
    

  $amount = $_POST['amount'];

  $phonenumber = $_POST['phonenumber'];
  $tel= ltrim($phonenumber, 0) ;
  //* Prepare our mobile money request
  


$headers = array(
    'Content-Type' => 'application/json',
);
$client = new GuzzleHttp\Client();
  $request_body = array(
    "client_id" => "4724952b-0266-4873-8ac6-e08714b4ce00",
    "client_secret"=> "76acb5e5-5f36-4cd2-9bad-1ce7b96f03cc",
    "grant_type" => "client_credentials"
);

try {
    $response = $client->request('POST','https://openapi.airtel.africa/auth/oauth2/token', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );

    if ($response->getStatusCode() == 200) {

    //$data = json_decode($response, TRUE);
    $arr = json_decode($response->getBody()->getContents(), true);
    //echo $arr['rows'][0]['elements'][0]['distance']['text'];
    //$data = json_decode($arr);
    $credentials =implode(array($arr['access_token']));    
    //print_r("Payment successful \n");    
    //print_r($arr);
    //print_r($credentials);
    echo "<script>window.location='verifypayment.php?credentials=$credentials&amount=$amount&tel=$tel'</script>"; 

    


    }else{
        print_r("Payment unsuccessful");    

    }
    
    
    
    
 }
 catch (GuzzleHttpExceptionBadResponseException $e) {
    // handle exception or api errors.
    //print_r($e->getMessage());
    http_response_code(500);
    echo '<script>We can not process your payment</script>';
 }


 //echo json_encode($response);
 
 //$response1= strval($response);
 //$res = json_decode($response1);

 
 

 


}
 
 ?>

