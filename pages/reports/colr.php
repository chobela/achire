<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../../App.php");
$app = new App();

$startdate = $_GET['startdate'];
$enddate = $_GET['enddate'];

$start = date('Y-m-d', strtotime($startdate));
$end = date('Y-m-d', strtotime($enddate));


$res = $app->getCollections($start,$end);

$result = array();
while($row = mysqli_fetch_array($res)){


$debtorname = $app->getDebtorName($row['debtor_id']);
$comment = $app->debtorComment($row['debtor_id']);
$paytype = $app->paymentType($row['type']);

  

array_push($result,
array('Debtor'=> $debtorname,
'Collected'=> 'K '.number_format($row['amount'],2),
'Type'=> $paytype,
'Date'=>   date("d/m/Y", strtotime($row['date'])),
'Latest Comment'=> $comment
));
}
echo json_encode(array("data"=>($result)));

?>

