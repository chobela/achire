<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
include 'smsconfig.php';

require_once 'classes/class.sms.php';

$useridx = $_POST['userid'];
$messagex = $_POST['message'];
$titlex = $_POST['title'];


$date = date('Y-m-d');

$f = date('m/d/Y h:i:s a', time());
$time = date("G:i:s", strtotime($f));

$sq = "INSERT INTO promotions (userid, title, message, date, time) VALUES ('$useridx', '$titlex', '$messagex', '$date', '$time')";
mysqli_query($db, $sq);


$sql2 = "SELECT *, promotions.userid AS uuid, promotions.id AS pid FROM promotions LEFT JOIN users ON promotions.userid = users.userid ORDER BY promotions.id DESC LIMIT 1";

$res = mysqli_query($db,$sql2);
$r=mysqli_fetch_assoc($res);

$sender = $r['senderid'];
$message = $r['message'];
$userid = $r['uuid'];
$pid = $r['pid'];


$sql3 = "SELECT senderid FROM users WHERE userid = '$useridx'";

$res = mysqli_query($db,$sql3);
$r=mysqli_fetch_assoc($res);

$sender = $r['senderid'];


$sql = "SELECT number FROM numbers";
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

