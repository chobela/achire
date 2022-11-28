<?php
include("../config.php");
include("../classes/App.php");

$app = new App;

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

if ( ($_POST['ref']!="") && ($_POST['status']!="")){

$did = $_POST['did'];
$ref = $_POST['ref'];
$status = $_POST['status'];
$user = $_POST['user'];
$debtorname = $_POST['debtorname'];


	$sql = mysqli_query($db,"UPDATE debtors SET status = '$status' WHERE ref ='$ref'");

	//$sql = mysqli_query($db,"INSERT INTO test (ref, status) VALUES ('$ref', '$status')");

if ($sql) {
	$app->sendaction('2', $user, 'Changed status for ' . $debtorname);
echo 'ref : '. $ref . ' status : '. $status . ' User : ' . $user . ' debtorname : ' . $debtorname;
}


header('Location: singledebtor.php?id='.$did);
	
}
	
?>