<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT sentmessages.*, debtors.name FROM sentmessages JOIN debtors ON sentmessages.debtorid = debtors.id WHERE sent_on > '$start' AND sent_on < '$end' ORDER BY sent_on ASC";

$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


$newDate = date("M jS, Y", strtotime($row['sent_on']));	

array_push($result,
array(
'Sent By'=> $row['user'],
'Message'=> $row['message'],
'Debtor'=> $row['name'],
'Sent to'=> $row['number'],
'Status'=> $row['poststatus'],
'Date'=> $row['sent_on']
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
