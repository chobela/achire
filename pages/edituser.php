<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
include("../config.php");
include("../classes/App.php");


//Get the current location
$link = $_SERVER['PHP_SELF'];
$id = $_SESSION['id'];



if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['userid']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }

$app = new App;

$name = $_SESSION ['firstname'];
$uid = $_GET['uid'];
$uname = $_GET['uname'];



$user = $app->singleuser($uid);

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
      Edit App User : <?php echo $uname;?>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">




 <div class="box box-info">
     <form action="formposts.php" class="form-horizontal" method="post" enctype="multipart/form-data" name="form" id="form">

<div class="box-body">
    


   <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">FirstName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="FirstName" value="<?php echo $user['firstname']?>" name="firstname" id="firstname">
     
                    </div>
                </div>

                  <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">LastName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="LastName" value="<?php echo $user['lastname']?>" name="lastname" id="lastname">
     
                    </div>
                </div>
    


                <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Role</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="role" id="role">
                        <option value="<?php echo $user['roleid']?>" selected><?php echo $user['role']?></option>
                            <?php 
                           $types = $app->getroletypes();
                              foreach($types as $r) { 
                                echo "<option value=\"$r[id]\">$r[role]</option>";
                              }
                          ?>
                                 
                        </select>
                        
                    </div>
                      
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Email</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Email" value="<?php echo $user['email']?>" name="email" id="email">
     
                    </div>
                </div>


                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">UserName</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="UserName" value="<?php echo $user['username']?>" name="username" id="username">
     
                    </div>
                </div>


               <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Password</label>                      
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Password" value="<?php echo $user['password']?>" name="password" id="password">
     
                    </div>
                </div>

             <div class="form-group">
                    <label form="" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="status" id="status">
                        <option value="<?php echo $user['statusid']?>" selected><?php echo $user['status']?></option>
                            <?php 
                           $rights = $app->userstatuses();
                              foreach($rights as $r) { 
                                echo "<option value=\"$r[id]\">$r[status]</option>";
                              }
                          ?>
                                 
                        </select>
                        
                    </div>
                      
                </div>
      
    

            </div>
                  <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="edit_user">
                  <input type="hidden" name="uid" class="form-control" id="uid" value="<?php echo $user['uid']?>">
                 
                  
                   <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="parent.location='users.php'">Back</button>
                    <button type="submit" class="btn btn-info pull-right submit-button">Update</button>
                </div><!-- /.box-footer -->
     </form>
</div>
<!-- /.box -->

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


    <script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        scrollX: true,
        bFilter: true, 
        filter: true,
        bInfo: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    } );
} );

    </script>
 

 


</body>
</html>