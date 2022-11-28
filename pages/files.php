<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../config.php");
include("../classes/App.php");

$app = new App;

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

if ($_FILES['file']){

$file = $_FILES['file'];
$filename = $file['name'];
$debtorid = $_POST['debtorid'];
$user = $_POST['user'];
$debtorname = $_POST['debtorname'];

$path = "uploads/" . basename($debtorid.$filename);
move_uploaded_file($file['tmp_name'], $path);

$sql = mysqli_query($db,"INSERT INTO files (did, filename, path) VALUES ('$debtorid','$filename','" . mysqli_real_escape_string($db,$path) . "')");
	
if ($sql) {
	$app->sendaction('5', $user, 'Added a Document for ' . $debtorname);
    header('Location: singledebtor.php?id='.$debtorid);
}
	
}
	
?>