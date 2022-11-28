<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('../config.php');

$userid = $_POST['userid'];
$email = $_POST['email'];
$name = $_POST['name'];
$address = $_POST['address'];
$smtpauth = $_POST['smtpauth'];
$smtpsecure = $_POST['smtpsecure'];
$username = $_POST['username'];
$password = $_POST['password'];
$port=$_POST['port'];


    
$sql = mysqli_query($db,"UPDATE email_settings SET email = '$email', name = '$name', address = '$address', smtpauth = '$smtpauth', smtpsecure = '$smtpsecure', username = '$username', password = '$password', port = '$port' WHERE userid = '$userid'");

header('location:esettings.php');
   

?>