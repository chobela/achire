<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT calls.*, debtors.name FROM calls JOIN debtors ON calls.debtorid = debtors.id WHERE calldate > '$start' AND calldate < '$end' ORDER BY calldate DESC";

$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


$newDate = date("M jS, Y", strtotime($row['datetime']));	

array_push($result,
array(
'Debtor'=> $row['name'],
'Sent By'=> $row['kam'],
'Status'=> $row['callstatus'],
'Date/Time'=> $row['datetime'],
'Number Called'=> $row['numbercalled']
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
