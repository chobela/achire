<?php
include_once("../config.php");

if(isset($_POST['emp_id'])) {
	$emp_id = trim($_POST['emp_id']);	
	$sql = "DELETE FROM payments WHERE id IN ($emp_id)";
	$resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($db));
	echo $emp_id;
}
?>