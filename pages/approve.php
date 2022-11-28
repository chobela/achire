<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../config.php");


$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

//if ( ($_POST['pay_id']!="") && ($_POST['status']!="")){

$pay_id = $_POST['pay_id'];
$status = $_POST['status'];
$type = $_POST['ptype'];
$debtorid = $_POST['debtor_id'];
$myamount = $_POST['myamount'];

if ($status == '1'){

	$x = '0';

} else {

	$x = '1';

}



	$sql = mysqli_query($db,"UPDATE payments SET status = '$x' WHERE id = '$pay_id'");

	

if ($sql) {

	switch ($type) {

  case '1':
    mysqli_query($db,"UPDATE debtors SET collected = (collected + '$myamount') WHERE id = '$debtorid'");
    break;

  case '2':
    mysqli_query($db,"UPDATE debtors SET write_off = (write_off + '$myamount') WHERE id = '$debtorid'");
    break;

  case '3':
    mysqli_query($db,"UPDATE debtors SET disputed = (disputed + '$myamount') WHERE id = '$debtorid'");
    break;
    
  case '4':
    mysqli_query($db,"UPDATE debtors SET handed_back = (handed_back + '$myamount') WHERE id = '$debtorid'");
    break;
}


  $response = array (
  'resp' => '1',
);

echo json_encode($response);
header('contentType: application/json');


} else {


  $response = array (
  'resp' => '0',
);

echo json_encode($response);
header('contentType: application/json');
}



	
//}
	
?>