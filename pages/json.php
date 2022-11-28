<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");


$sql = "SELECT id, firstname FROM users WHERE groupe <> '1'";
$res = mysqli_query($db,$sql);


$data = [];
while ($row = mysqli_fetch_array($res)) {
    $data[$row['id']] = $row['firstname'];
}


echo json_encode($data);
mysqli_close($db);
?>
