<?php
include 'vendor/autoload.php';
function generateRandomString($length = 10) {
   return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
};
$credentials=$_REQUEST['credentials'];
$amount=$_REQUEST['amount'];
$tel=$_REQUEST['tel'];
$headers = array(
    'Content-Type' => 'application/json',
    'X-Country' => 'UG',
    'X-Currency' => 'UGX',
    'Authorization'  => $credentials,
);
$client = new GuzzleHttp\Client();
// Define array of request body. 
$request_body = array(
    
   "reference" => "Payment transaction", 
   "subscriber" => [
         "country" => "UG", 
         "currency" => "UGX", 
         "msisdn" => $tel
      ], 
   "transaction" => [
            "amount" => $amount, 
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
    if ($response->getStatusCode() == 200) {
    //print_r($response->getBody()->getContents());
    $result='<div class="alert alert-warning">Authorize transaction to continue</div>';
    
    }else{
      //print_r("Payment unsuccessful");
      $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';   
    }
 }
 catch (GuzzleHttpExceptionBadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }
 // ...
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Successful</title>
 </head>
 <body>
<div class="d-flex justify-content-center">
   <div class="align-self-center" style="margin-top:50px; width:500px">
 <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <?php echo $result; ?>    
        </div>
    </div>
</div>
</div>
 </body>
 </html>