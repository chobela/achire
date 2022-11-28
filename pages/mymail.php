<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('../config.php');
$userid = $_SESSION['userid'];
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


error_reporting(E_STRICT | E_ALL);
/* Include the Composer generated autoload.php file. */
require '../../composer/vendor/autoload.php';

$userid = $_SESSION['userid'];

$subject = $_POST['subject'];
$message = $_POST['message'];

$esql = "SELECT * FROM email_settings WHERE userid = '$userid'";
$eres = mysqli_query($db,$esql);
$e=mysqli_fetch_assoc($eres);

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
   $mail = new PHPMailer(TRUE);
   
   $mail->setFrom($e['email'], $e['name']);
   
   $mail->addReplyTo($e['email'], $e['name']);
   $mail->Subject = $subject;
   /* Tells PHPMailer to use SMTP. */
  
   $mail->isSMTP();
   /* SMTP server address. */
   //41.60.188.126
   //10.1.11.4
   $mail->Host = $e['address'];
   /* Use SMTP authentication. */
   $mail->SMTPAuth = $e['smtpauth'];
   /* Set the encryption system. */
   $mail->SMTPSecure = $e['smtpsecure'];
   /* SMTP authentication username. */
   $mail->Username = $e['username'];
   /* SMTP authentication password. */
   $mail->Password = $e['password'];
   /* Set the SMTP port. */
   $mail->Port = $e['port'];
      /* Disable some SSL checks. Train123!*/
   $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
   );
   
//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database

$result = mysqli_query($db, "SELECT email FROM emails WHERE email = 'chobelak@gmail.com'");
//SELECT id FROM appusers ORDER BY id ASC LIMIT 100 OFFSET 51
foreach ($result as $row) {
    try {
        $mail->addAddress($row['email']);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row['email']) . '<br>';
        continue;
    }
  
    try {

        $mail->Body = $message;


        //$mail->AddAttachment('Job_description.pdf');
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->isHTML(true);
        $mail->send();
        echo 'Message sent to : (' . htmlspecialchars($row['email']) . ')<br>';

        //Mark it as sent in the DB
        mysqli_query(
            $db,
            "INSERT INTO sentemails (email) VALUES ('".mysqli_real_escape_string($db, $row['email'])."')"
        );
    } catch (Exception $e) {
        echo 'Mailer Error (' . htmlspecialchars($row['email']) . ') ' . $mail->ErrorInfo . '<br>';
        //Reset the connection to abort sending this message
        //The loop will continue trying to send to the rest of the list
        $mail->smtp->reset();
    }
    //Clear all addresses and attachments for the next iteration
    $mail->clearAddresses();
    $mail->clearAttachments();
}
