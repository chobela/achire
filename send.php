<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
include 'smsconfig.php';

require_once 'classes/class.sms.php';

$date = date('Y-m-d');

$f = date('m/d/Y h:i:s a', time());
$time = date("G:i:s", strtotime($f));


$sql2 = "SELECT *, promotions.userid AS uuid, promotions.id AS pid FROM promotions LEFT JOIN users ON promotions.userid = users.userid WHERE promotions.date = '$date' AND promotions.time = 'time'";

$res = mysqli_query($db,$sql2);
$r=mysqli_fetch_assoc($res);

$sender = $r['senderid'];
$message = $r['message'];
$userid = $r['uuid'];
$pid = $r['pid'];

$sql = "SELECT number FROM numbers WHERE number = '260954152223'";
$result = mysqli_query($db,$sql);

if ($result->num_rows > 0) {
while($row=mysqli_fetch_assoc($result)) {


/********** Begin Send SMS *********/		
			$sms = new SMSPost ;
			
			$sms->Destination = $row['number'];
			
			$sms->SenderAddress = $sender;

			
			$sms->Message  = $message;

			$sms->UserId = $userid;
			$sms->PromoId = $pid;
			
			$sms->sendSMS() ;
	
/********** End Send SMS *********/

}};
?>

