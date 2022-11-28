<?php
header('Content-Type: application/json');

require_once('config.php');

$sqlQuery = "SELECT statuses.type, COUNT(*) AS number, SUM(owing) AS value FROM debtors JOIN statuses ON statuses.id = debtors.status GROUP BY status";

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