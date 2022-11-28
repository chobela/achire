<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
 session_start();
include("config.php");
include("classes/App.php");


//Get the current location
$link = $_SERVER['PHP_SELF'];

//send php self of index file to server for loading logo purposes
mysqli_query($db, "update config set index_php_self='$link'");

if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['firstname'])   && !isset ($_SESSION ['email'])) {

  header('Location: login.php');
 
 }
 
 $id = $_SESSION ['id'];
 $name = $_SESSION ['firstname'];
 $group = $_SESSION ['group'];

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

 <script src="js/pace.js"></script>
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
  <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
  


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition <?php echo $app->getappcolor();?> fixed sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php
include ('includes/header.php');
include ('includes/index_sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    

    <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Report</h3>
            </div>
            <div class="row">
                <div class="col-xs-11 margin">
                    <select class="form-control" name="report_type" id="report_type">
                    	<option value="reports/collections.php" selected="">Collections</option>
                        <option value="reports/comments.php">Comments</option>
                        <option value="reports/ptp.php">Promise To Pay</option>
                        <option value="reports/messages.php">SMS History</option>
                        <option value="reports/calls.php">Call History</option>
                    </select>
                </div>
        
            </div>
        </div>

        <div style="border-color: #222D32;" class="box">
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
                                  <button onclick="getMyData()" id="clickMe" class="btn bg-black">Search</button>
                                </span>
                                <span class="input-group-btn">
                                  <button class="btn bg-black pull-right"  onclick="clearDT()">Reset</button>
                                </span>
                            </div>
                        </div>
                  </div><!-- /.box-body -->
            </div>

             <div style="border-color: #222D32;" class="box">
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
  </div>
  <!-- /.content-wrapper -->
 <?php
 include ('includes/footer.php');
 ?>
 
</div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

 <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
   <!-- chart js.js -->


 <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://nightly.datatables.net/buttons/js/buttons.print.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

  <script type="text/javascript">
      var columns = [];

function getMyData() {

    
     d = document.getElementById("report_type").value;
     startdate = document.getElementById('startpicker').value;
     enddate = document.getElementById('endpicker').value;

   
        console.log(d);
    $.ajax({

      url: d+"?startdate="+startdate+"&enddate="+enddate,
      
      //data:{startdate:startdate, enddate:enddate},
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        columnNames = Object.keys(data.data[0]);
        for (var i in columnNames) {
          columns.push({data: columnNames[i], 
                    title: capitalizeFirstLetter(columnNames[i])});
        }

      $('#example').DataTable( {
        bSort:false,
        bFilter: true, 
        filter: true,
        bInfo: true,
        serverSide: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        oLanguage: {
           "sSearch": "Search By CAM"
         },
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