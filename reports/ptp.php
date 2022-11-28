<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT ptp.*, ptpstatuses.ptptype, ptpstatuses.id AS pid FROM ptp JOIN ptpstatuses ON ptp.status = ptpstatuses.id  WHERE ptp.date > '$start' AND ptp.date < '$end' ORDER BY date ASC";

$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){


$newDate = date("M jS, Y", strtotime($row['date']));	

array_push($result,
array('Amount Promised'=> 'K'.number_format($row['amount'],2),
'Date Promised'=> $newDate,
'Status'=> $row['ptptype'],
'CAM'=> $row['kam']
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
