<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC950e9b014e6335859a5dcbf5ed21adf8';
$auth_token = '3a724351a404673b669d27a99530813d';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
$twilio_number = "+447412301423";

// Where to make a voice call (your cell phone?)
$to_number = '+'.$_GET['number'];
$kam = $_GET['kam'];
$did = $_GET['did'];

$client = new Client($account_sid, $auth_token);
$client->account->calls->create(  
    $to_number,
    $twilio_number,
    array(
        "method" => "POST",
        "url" => "https://app-express.net/test.xml",
         "statusCallback" => "https://app-express.net/achire/pages/twilio/webhook.php?kam=".$kam."&did=".$did,
        "statusCallbackEvent" => ["initiated","ringing", "answered", "completed"],
        "statusCallbackMethod" => "GET"
    )
);
 header('location:../singledebtor.php?id='.$did);


/*Status Codes

Called=%2B260967301606&
ToState=&
CallerCountry=GB
Direction=outbound-api
Timestamp=Sat%2C%2007%20May%202022%2014%3A30%3A14%20%2B000
&CallbackSource=call-progress-events
SipResponseCode=486
CallerState=
ToZip=
SequenceNumber=2
CallSid=CA35c037c9b8bb40c5002e2fe8cbbeecd9
To=2B260967301606
CallerZip=
ToCountry=ZM
CalledZip=
ApiVersion=2010-04-01
CalledCity=
CallStatus=busy
Duration=0
From=2B447412301423
CallDuration=0
AccountSid=AC950e9b014e6335859a5dcbf5ed21adf8
CalledCountry=ZM
CallerCity=
ToCity=
FromCountry=GB
Caller=
2B447412301423
FromCity=
CalledState=
FromZip=
FromState=

*/
?>
