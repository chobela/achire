<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT comments.*, debtors.name FROM comments JOIN debtors ON comments.did = debtors.id WHERE comments.date > '$start' AND comments.date < '$end' ORDER BY date ASC";

$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){

array_push($result,
array('Debtor'=> $row['name'],
'Comment'=> $row['comment'],
'Date'=> $row['date'],
'CAM'=> $row['kam']
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
