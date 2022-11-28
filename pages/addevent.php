<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config.php");
include("../classes/App.php");

$app = new App;

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERROR"}';
}

if ($_POST['title']!=""){

$title = $_POST['title'];
$startdate1 = $_POST['startdate'];
$enddate1 = $_POST['enddate'];
$kamid = $_POST['kamid'];
$class = $_POST['class'];


$startdate = date('Y-m-d H:i:s', strtotime("$startdate1"));
$enddate = date('Y-m-d H:i:s', strtotime("$enddate1"));



	$sql = mysqli_query($db,"INSERT INTO events (title, start_date, end_date, created, status, kam_id, class) VALUES ('$title', '$startdate', '$enddate', NOW(), '1', '$kamid', '$class')");

if ($sql) {
 header('Location: calendar.php');

} else {

echo 'An error occured';

}
}

	
?>