<?php 
require("../App.php");
$app = new App;
session_start();
$app->sendaction('7', $_SESSION['id'], "Logged out");


    $_SESSION['username'] = NULL;
    $_SESSION['password'] = NULL;
    $_SESSION['email'] =  NULL;
session_unset();
header("Location: ../index.php");
?>
