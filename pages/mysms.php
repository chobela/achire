<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
include("../config.php");
include("../classes/App.php");


//Get the current location
$link = $_SERVER['PHP_SELF'];
$id = $_SESSION['id'];
$group = $_SESSION['group'];
$did = $_GET['did'];
$uid = $_GET['uid'];

$dsql = "SELECT * FROM debtors WHERE debtors.id = '$did'";
$dresult = mysqli_query($db,$dsql);
$drow = mysqli_fetch_assoc($dresult);


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }
 
 $name = $_SESSION ['firstname'];

$app = new App;

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
    <section class="content-header">
      <h1>
        Send SMS
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

 <div class="row">

   <div class="col-md-6">
          <!-- general form elements -->
         <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $drow['name']?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="sms.php" method="POST">
              <div class="box-body">

                 <input type="hidden" id="charx" name="charx" value="1">


                 <input type="hidden" name="uid" id="uid" class="form-control" value="<?php echo $uid ?>">
                 <input type="hidden" name="did" id="did" class="form-control" value="<?php echo $did ?>">

                   <div class="form-group">
                  <label>Phone number</label>
                  <input type="text" class="form-control" value="<?php echo $drow['phone']?>" disabled>
                    <input type="hidden" name="number" id="number" class="form-control" value="<?php echo $drow['phone']?>">
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                 
                  <textarea class="form-control textarea2" name="message" id="message" rows="5" maxlength="640" placeholder="Message ..."></textarea>
                </div>
                <!--  <div><p id="chars2">160 chars remaining.</p></div>-->

                   <div><p id="chars2">160 chars = 1 SMS</p></div>
                    <div><p id="num2"></p></div>

                 
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn bg-black">Send Now</button>
              </div>
            </form>
          </div>
       </div>

       <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Placeholders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-left">

              <ul>
                
                <li><p>Amount Owing : <code>{owing}</code></p></li>
                 <li><p>Mobile Money Link : <code>{link}</code></p></li>
                 <li><p>Reference ID : <code>{ref}</code></p></li>
                <li><p>Debtor Name : <code>{name}</code></p></li>
                <li><p>Total Collected : <code>{collected}</code></p></li>
              </ul>
              

            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
   
 </div>





    </section>
    <!-- /.content -->

          <!-- /.box -->
  </div>

  <!-- /.content-wrapper -->
 <?php
 include ('../includes/footer.php');
 ?>
 
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

  <script>
      
          $('.textarea2').keyup(function() {
        var length = $(this).val().length;
        $('#chars2').text(length + ' characters.');

          if(length < 161){
            $('#num2').text('1 SMS');
            $('#charx').val('1');
          } else if (length > 160 && length < 321) {
            $('#num2').text('2 SMS');
            $('#charx').val('2');
          } else if (length > 321 && length < 481) {
            $('#num2').text('3 SMS');
            $('#charx').val('3');
          } else if(length > 480 && length < 641) {
            $('#num2').text('4 SMS');
            $('#charx').val('4');
          } else {
            $('#num').text('5 SMS');
            $('#charx').val('5');
          }

      });

    </script>

 
</body>
</html>