<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../config.php");
include("../classes/App.php");


$data = $_POST['value'];//id of new cam
$id = $_POST['id'];//column name of cam
$debtor = $_POST['debtor'];//debtor id

$sql = "UPDATE debtors SET $id = '$data' WHERE id = $debtor";


if (mysqli_query($db, $sql)) {
  echo $data;
  //$app->sendaction('2', $data, 'Pushed debtor id : ' . $debtor . 'to : ' . $data);
} else {
  echo "Error updating record: " . mysqli_error($db);
}

?>