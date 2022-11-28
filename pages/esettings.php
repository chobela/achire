<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../config.php");
include("../classes/App.php");


//Get the current location
$link = $_SERVER['PHP_SELF'];
$id = $_SESSION['id'];
$userid = $_SESSION['userid'];


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['firstname'])   && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 } 
 
 $name = $_SESSION ['firstname'];

$app = new App;

$esql = "SELECT * FROM email_settings WHERE userid = '$userid'";
$eres = mysqli_query($db,$esql);
$e=mysqli_fetch_assoc($eres);

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


<style>
.ck-editor__editable_inline {
    min-height: 175px;
}
</style>

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
        Email settings
      
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
         
 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Outgoing</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="mailset.php">
              <div class="box-body">

                 <input class="form-control" type="hidden" id="userid" value="<?php echo $e['userid'];?>" name="userid">

                  <div class="form-group">
                  <label for="email">Sender Email Address</label>
                  <input class="form-control" id="email" value="<?php echo $e['email'];?>" name="email" placeholder="Sender Email Address here">
                </div>

                <div class="form-group">
                  <label for="sendername">Sender Name</label>
                  <input class="form-control" id="name" name="name" value="<?php echo $e['name'];?>" placeholder="Name that will appear to your recepients">
                </div>

               <div class="form-group">
                  <label for="address">Server Address</label>
                  <input class="form-control" id="address" value="<?php echo $e['address'];?>" name="address" placeholder="Server/Host Address. e.g: 10.5.22.5">
                </div>

                <div class="form-group">
                 <label>SMTP Auth</label>
                <select class="form-control select2" id="smtpauth" name="smtpauth" style="width: 100%;">
                  <option selected="selected" value="TRUE">TRUE</option>
                  <option value="FALSE">FALSE</option>
                </select>
                </div>

              <div class="form-group">
                  <label for="smtpsecure">SMTP Secure</label>
                  <input class="form-control" id="smtpsecure" name="smtpsecure" value="<?php echo $e['smtpsecure'];?>" placeholder="Set the encryption system. e.g: ssl, tls, htps">
                </div>

                 <div class="form-group">
                  <label for="username">Username</label>
                  <input class="form-control" id="username" value="<?php echo $e['username'];?>" name="username" placeholder="SMTP Username">
                </div>

              
                 <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control" id="password" value="<?php echo $e['password'];?>" name="password" placeholder="SMTP Password">
                </div>

                <div class="form-group">
                  <label for="port">Port</label>
                  <input class="form-control" id="port" value="<?php echo $e['port'];?>" name="port" placeholder="SMTP Port">
                </div>

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>

          </div>

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

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
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
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>



    <script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        bFilter: false, 
        bInfo: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

    </script>
  <script type="text/javascript">
     //Date picker
    $('#date').datepicker({
      autoclose: true,
      dateFormat: 'yyyy-mm-dd'
    });


  </script>

  <script type="text/javascript">  
           //Timepicker
    $('.time').timepicker({
      showInputs: false
    });
  </script>

   <script>
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .resize( '100%', '550' )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>

</body>
</html>