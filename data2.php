<?php
header('Content-Type: application/json');

require_once('config.php');

// $sqlQuery = "SELECT * FROM payments";
$sqlQuery = "SELECT kam, SUM(payments.amount) AS amount, DATE_FORMAT(payments.date, '%d/%m/%Y')  AS type, kam FROM payments GROUP BY payments.date, kam ORDER BY payments.date ASC";

//desc, number

//SELECT status, number FROM debtors

$result = mysqli_query($db,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($db);

echo json_encode($data);
?>