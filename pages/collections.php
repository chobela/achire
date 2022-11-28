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
        Collections
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Date Range</h3>
            </div>
                <div class="box-body">
                    <div class="row">

                    <div class="col-sm-5">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                       </div>
                        <input type="text" name="startdate" class="form-control" id="startpicker" placeholder="Start Date" value="" autocomplete="off">
                        </div>
                    </div>
                 
                  

                        <div class="col-sm-1  text-center" style="padding-top: 5px;">
                            to
                        </div>


                           <div class="col-sm-5">
                      <div class="input-group date">
                        
                      
                       <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                       </div>
                        <input type="text" name="enddate" class="form-control" id="endpicker" placeholder="End Date" value="" autocomplete="off">
                        </div>
                    </div>



                     </div>
                    <div class="row search_str">
                        <br>
                    
                    </div>    
                </div>
                  <div class="box-body">
                       <div class="row">
                            <div class="col-xs-2">
                                <span class="input-group-btn">
                                  <button onclick="getDT()" class="btn bg-primary btn-flat">Search</button>
                                </span>
                                <span class="input-group-btn">
                                  <button class="btn bg-primary  btn-flat pull-right"  onclick="clearDT()">Reset</button>
                                </span>
                            </div>
                        </div>
                  </div><!-- /.box-body -->
            </div>

             <div class="box box-primary">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Report</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
               
              </table>
                
            </div>
          
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

        var columns = [];

function getDT() {
    
     d = "reports/colr.php";

     startdate = document.getElementById('startpicker').value;
     enddate = document.getElementById('endpicker').value;

    
    
    $.ajax({

      url: d+"?startdate="+startdate+"&enddate="+enddate,
      
    
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        columnNames = Object.keys(data.data[0]);
        for (var i in columnNames) {
          columns.push({data: columnNames[i], 
                    title: capitalizeFirstLetter(columnNames[i])});
        }
      $('#example').DataTable( {
         "columnDefs": [
    { "width": "20%", "targets": 0 }
  ],
        bSort:false,
        bFilter: true, 
        filter: true,
        bInfo: true,
        serverSide: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        processing: true,
        serverSide: false,
        bDestroy: true,
        ajax: d+"?startdate="+startdate+"&enddate="+enddate,
        columns: columns
      } );
      }
    });
}

function clearDT() {
    
  location.reload();
    
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

    </script>
 

         <!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
 //Date picker
    $('#startpicker').datepicker({
      autoclose: true
    })
</script>
<script>
 //Date picker
    $('#endpicker').datepicker({
      autoclose: true
    })
</script>


</body>
</html>