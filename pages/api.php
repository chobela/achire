<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
include("../config.php");
include("../classes/App.php");


//Get the current location
$link = $_SERVER['PHP_SELF'];
$id = $_SESSION['id'];
$userid = $_SESSION['userid'];


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['userid']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }
 
 $name = $_SESSION ['firstname'];

$app = new App;

require 'twilio/vendor/autoload.php';

use GuzzleHttp\Client;
//Call Balance
$apikey = 'cf0be1359d22db08da65';
$account_sid = 'AC950e9b014e6335859a5dcbf5ed21adf8';
$auth_token = '3a724351a404673b669d27a99530813d';
$endpoint = "https://api.twilio.com/2010-04-01/Accounts/$account_sid/Balance.json";

// Define the Guzzle Client
$client = new Client();
$response = $client->get($endpoint, [
   'auth' => [
       $account_sid,
       $auth_token
   ]
]);
$result = $response->getBody();
$jsonArray = json_decode($result,true);
$callbalance = $jsonArray['balance'];

//SMS Balance
$fields = array('username' => 'chobela12', 'password' => 'theresa1');

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($fields),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents(base64_decode("aHR0cDovL2FwaS5ybWxjb25uZWN0Lm5ldC9DcmVkaXRDaGVjay9jaGVja2NyZWRpdHM="), false, $context);

$postresult = explode("|", trim($result)) ;

$smsbalance = $postresult[0];


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $app->getappname();?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

<script>
function myFunction() {
    var x = "Is the browser online? " + navigator.onLine;
    document.getElementById("network").innerHTML = x;
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
 <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
<!-- DataTables -->
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">




  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<body class="hold-transition <?php echo $app->getappcolor();?> fixed sidebar-mini">
<div class="wrapper">

<?php
include ('../includes/header.php');
include ('../includes/sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">


<div class="row">

    <div id="loading" class="loader loader-bar is-active"></div>
   
<div class="col-md-4">

 <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">API Details</h3> 


            </div>

             <div class="box-body">


          <div class="row">

                <div class="col-md-6">
                  <h5><span style="font-weight: bold;">SMS Credit : </span><?php echo str_replace("BALANCE:","",$smsbalance);?> EUR</h5>
                  
                </div>
                
                  <div class="col-md-6">
                  
                </div>

              </div>
                           <div class="row">

                <div class="col-md-6">
                  <h5><span style="font-weight: bold;">Call Credit : </span><?php echo $callbalance;?> USD</h5>
                  
                </div>
                
                  <div class="col-md-6">
                  
                </div>

              </div>

     
          </div>
          
          </div>
          <!-- /.box -->
        </div>


</div>   
               

</section>
 
</div>

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

    <!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>

<script type="text/javascript">
  $("#loading").hide();  
</script>



</body>
</html>