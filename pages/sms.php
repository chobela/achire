<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';
include 'smsconfig.php';

require_once 'class.sms.php';

//dentor id
$did = $_POST['did'];
//kam id
$kam = $_POST['uid'];
//message
$messagex = $_POST['message'];
//phone
$number = $_POST['number'];
//number of characters
$chars = $_POST['charx'];

$sql = "SELECT * FROM debtors WHERE id = '$did'";

$res = mysqli_query($db,$sql);
$r=mysqli_fetch_assoc($res);

$uuid = guidv4();

//formated message
$message = str_replace(array('{ref}', '{owing}', '{name}','{collected}', '{link}'), array($r['ref'], $r['owing'],$r['name'],$r['collected'], 'https://app-express.net/achire/client/?link=' . $uuid), $messagex);

$sql3 = "SELECT firstname FROM users WHERE id = '$kam'";

$resx = mysqli_query($db,$sql3);
$rs=mysqli_fetch_assoc($resx);

//kam firstname
$user = $rs['firstname'];




$sql4 = "INSERT INTO momolinks (kam, debtorid, link_id, created_on, clicked_on) VALUES ('$user', '$did', '$uuid', NOW(), NOW())";

mysqli_query($db,$sql4);


function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


//sender id
$sender = 'Achire';


/********** Begin Send SMS *********/		
			$sms = new SMSPost ;
			
			$sms->Destination = $number;
			
			$sms->SenderAddress = $sender;
	
			$sms->Message  = $message;

			$sms->User = $user;
		
			$sms->Chars = $chars;

			$sms->Debtorid = $did;
			
			$sms->sendSMS() ;
	
/********** End Send SMS *********/
	header('location:singledebtor.php?id='.$did);



?>

