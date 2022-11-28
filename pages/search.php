<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

if ($_POST['debtor']!=""){

$debtor = $_POST['debtor'];

	$sql = "SELECT id, name FROM debtors WHERE name LIKE '%$debtor%' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($db, $sql);

	$row = mysqli_fetch_assoc($result);

if ($sql) {
    header('Location: singledebtor.php?id='.$row['id']);
}
	
}
	
?>