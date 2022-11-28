<?php
session_start();
include("../App.php");

$uid = $_SESSION['id'];

$callstatus = $_GET['CallStatus'];
$numbercalled = $_GET['Called'];
$timestamp = $_GET['Timestamp'];
$kam = $_GET['kam'];

$app = new App;

$app->saveCall($uid, $callstatus, $numbercalled, $timestamp);

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