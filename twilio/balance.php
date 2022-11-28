<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
//Call Balance
$apikey = 'cf0be1359d22db08da65';
$account_sid = 'AC950e9b014e6335859a5dcbf5ed21adf8';
$auth_token = '3a724351a404673b669d27a99530813d';
$endpoint = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Balance.json";

// Define the Guzzle Client
$client = new Client();
$response = $client->get($endpoint, [
   'auth' => [
       $account_sid,
       $auth_token
   ]
]);

//SMS Balance
$fields = array('username' => 'chobela12', 'password' => 'theresa1');

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($fields),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents(base64_decode("aHR0cDovL2FwaS5ybWxjb25uZWN0Lm5ldC9DcmVkaXRDaGVjay9jaGVja2NyZWRpdHM="), false, $context);

$postresult = explode("|", trim($result)) ;

echo $postresult[0];
/*$result = $response->getBody();
$jsonArray = json_decode($result,true);
$balance = $jsonArray['balance'];

 

$from_Currency = urlencode('USD');
$to_Currency = urlencode('ZMW');
$query =  "{$from_Currency}_{$to_Currency}";


$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

$obj = json_decode($json, true);

$val = floatval($obj["$query"]);


$total = $val * $balance;


echo 'K '. number_format($total,2);*/


?>