<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("../classes/App.php");
include("../config.php");


$app = new App;


$form = $_POST['mm_insert'];

if ($form == 'add_user') {


  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];

 $app->add_user($firstname, $lastname, $role, $email, $username, $password, $status);

 header('location:users.php');


} else if ($form == 'edit_user'){

  $uid = $_POST['uid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];

 $app->edit_user($uid, $firstname, $lastname, $role, $email, $username, $password, $status);

 header('location:users.php');

} 

else if ($form == 'edit_ptp'){

  $uname = $_POST['uname'];
  $ptpid = $_POST['ptpid'];
  $status = $_POST['status'];
  $debtorid = $_POST['debtorid'];
  
 $app->edit_ptp($uname, $ptpid, $status, $debtorid);

 header('location:singledebtor.php?id='.$debtorid);

} 

else if ($form == 'clientpay'){

  $debtorid = $_POST['debtorid'];
  $code = $_POST['area_code'];
  $phone = $_POST['phone'];
  $amount = $_POST['amount'];
  $kam = $_POST['kam'];
  $number = $code . $phone;
  

 $res = $app->clientpay($number, $amount);

 $response = json_decode($res, true);
 $pid = $response["pid"];

 if($response["result"] == '0'){

  $app->addPayment($amount, $debtorid, $pid, $kam);

 }
  header('location:../pages/debtors.php');

}   

else if ($form == 'delete_user') {

  $uid = $_POST['id'];

  $app -> deleteUser($uid);

}

?>