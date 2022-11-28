<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));

$sql = "SELECT debtors.name, payments.amount, payments.status, transtypes.type, payments.date, payments.kam, transtypes.type FROM payments LEFT JOIN debtors ON payments.debtor_id = debtors.id LEFT JOIN transtypes ON payments.transtype = transtypes.id WHERE date > '$start' AND date < '$end' ORDER BY date ASC";



$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){

	if($row['status'] == '1'){
		$status = 'Approved';
		} else {
			$status = 'Pending Approval';
		}


array_push($result,
array('Debtor'=> $row['name'],
'Amount'=> 'K'.number_format($row['amount'],2),
'Status'=> $status,
'Transaction'=> $row['type'],
'Date'=> $row['date'],
'CAM'=> $row['kam']
));
}
echo json_encode(array("data"=>($result)));
mysqli_close($db);
?>
