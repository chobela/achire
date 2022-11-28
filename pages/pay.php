<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
include("../classes/App.php");

$app = new App;

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

if ( ($_POST['myamount']!="") && ($_POST['mydate']!="")){

$debtorid = $_POST['debtorid'];
$myamount = $_POST['myamount'];
$mydate = $_POST['mydate'];
$nextdate = $_POST['nextdate'];
$kam = $_POST['kam'];
$user = $_POST['user'];
$debtorname = $_POST['debtorname'];
$type = $_POST['type'];
$transtype = $_POST['transtype'];



	$sql = mysqli_query($db,"INSERT INTO payments (debtor_id, amount, status, type, date, nextdate, kam, trans_id, transtype) VALUES ('$debtorid', '$myamount', '0', '$type', '$mydate', '$nextdate', '$kam', '0', '$transtype')");


/*	switch ($type) {

  case '1':
    $sql2 = mysqli_query($db,"UPDATE debtors SET collected = (collected + '$myamount') WHERE id = '$debtorid'");
    break;

  case '2':
    $sql2 = mysqli_query($db,"UPDATE debtors SET write_off = (write_off + '$myamount') WHERE id = '$debtorid'");
    break;

  case '3':
    $sql2 = mysqli_query($db,"UPDATE debtors SET disputed = (disputed + '$myamount') WHERE id = '$debtorid'");
    break;
    
  case '4':
    $sql2 = mysqli_query($db,"UPDATE debtors SET handed_back = (handed_back + '$myamount') WHERE id = '$debtorid'");
    break;
}*/



	

if ($sql) {
	$app->sendaction('3', $user, 'Added Payment : K' . $myamount . ' from ' . $debtorname);
    header('Location: singledebtor.php?id='.$debtorid);
}
	
}
	
?>