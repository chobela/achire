<?php
require_once './vendor/autoload.php';
use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();
$dial = $response->dial('');
$dial->number('+260967301606',
    ['statusCallbackEvent' => 'initiated ringing answered completed',
    'statusCallback' => 'https://app-express.net/twilio/index.php',
    'statusCallbackMethod' => 'POST']);

echo $response;
