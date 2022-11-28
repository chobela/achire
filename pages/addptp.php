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

if ( ($_POST['myamount']!="") && ($_POST['ptpdate']!="")){

$debtorid = $_POST['debtorid'];
$myamount = $_POST['myamount'];
$mydate = $_POST['ptpdate'];
$kam = $_POST['kam'];
$debtorname = $_POST['debtorname'];
$user = $_POST['user'];


	$sql = mysqli_query($db,"INSERT INTO ptp (debtorid, amount, date, status, kam) VALUES ('$debtorid', '$myamount', '$mydate', '6', '$kam')");
	

if ($sql) {
	$app->sendaction('6', $user, 'Added PTP amount of : K' . $myamount . ' for ' . $debtorname);
    header('Location: singledebtor.php?id='.$debtorid);
}
	
}
	
?>