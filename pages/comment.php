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

if ($_POST['comment']!=""){

$debtorid = $_POST['debtorid'];
$comment = $_POST['comment'];
$user = $_POST['user'];
$debtorname = $_POST['debtorname'];
$kam = $_POST['kam'];
$date = date("Y-m-d");

	//$sql = mysqli_query($db,"UPDATE debtors SET status = '$status' WHERE ref ='$ref'");

	$sql = mysqli_query($db,"INSERT INTO comments (did, comment, date, kam) VALUES ('$debtorid', '$comment', NOW(), '$kam')");

if ($sql) {
	$app->sendaction('4', $user, 'Added comment for ' . $debtorname);
    header('Location: singledebtor.php?id='.$debtorid);
} else {

echo 'An error occured';

}

}
	
?>