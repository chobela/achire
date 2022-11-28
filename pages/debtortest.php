<?php
header("Access-Control-Allow-Origin: *");
include("../config.php");


$sql = "SELECT id, ref, name, phone, owing FROM debtors LIMIT 17";
$res = mysqli_query($db,$sql);

$result = array();
while($row = mysqli_fetch_array($res)){

$amt = $row[4];

array_push($result,
array(
'id'=>$row[0],
'ref'=>$row[1],
'name'=>$row[2],
'phone'=>$row[3],
'owing'=> number_format($amt,2)
));
}
echo json_encode($result);
mysqli_close($db);

?>