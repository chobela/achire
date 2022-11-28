<?php
	include('../config.php');
	$ids=$_POST['ids'];


$id = explode(",",$ids);
$size = sizeof($id);

foreach($id as $i){
    mysqli_query($db,"DELETE FROM numbers where id = '$i'");
}

	echo $size . ' numbers deleted successfully!';
	
	//header('location:promo.php');

?>