<?php 
session_start();
session_unset();
    $_SESSION['username'] = NULL;
    $_SESSION['password'] = NULL;
    $_SESSION['email'] =  NULL;
header("Location: ../../index.php");        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
