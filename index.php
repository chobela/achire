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

  if($group == '3' || $group == '5'){
  header('Location: cam.php');
 }

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
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- DataTables -->
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">

  <!-- chart js.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />



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
    <section class="content-header">
      <h1>
        Overview
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

     

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a style="color : black" href="pages/debtors.php">
            
          <div style="background-color : #dfC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number" id="dbt"><?php echo $app->getbookdebtors();?></h4>

              <p>Debtors</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            
          </div>
          </a>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <a style="color : black" href="pages/debtors.php">
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getbookvalue();?></h4>
              <h4 id="gbv" hidden><?php echo $app->getrawbookvalue();?></h4>

              <p>Total Outsourced</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           
          </div>
         </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getbookcollected();?></h4>

              <p>Total Collected</p>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->

   
               <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getTotalLegal();?></h4>

              <p>Legal status (balance)</p>
            </div>
            <div class="icon">
              <i class="fa fa-minus"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->

               <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getTotalUncontactable();?></h4>

              <p>Uncontactable (balance)</p>
            </div>
            <div class="icon">
              <i class="fa fa-exclamation"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->


          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getTotalHandBack();?></h4>

              <p>Handed Back</p>
            </div>
            <div class="icon">
              <i class="fa fa-hand-o-right"></i>
            </div>
        
          </div>
        </div>
        <!-- ./col -->
                  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number"><?php echo $app->getTotalptp();?></h4>

              <p>Total PTP</p>
            </div>
            <div class="icon">
               <i class="fa fa-exclamation"></i>
            </div>
        
          </div>
        </div>
        <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
             <a style="color : black" href="http://193.46.198.61:8088/superset/dashboard/p/gdbRE2Y651L/">
          <!-- small box -->
          <div style="background-color : #DFC977; cursor: pointer;" class="small-box">
            <div class="inner">
              <h4 class="info-box-number">Charts</h4>

              <p>More Charts...</p>
            </div>
            <div class="icon">
              <i class="fa fa-pie-chart"></i>
            </div>
        
          </div>
        </a>
        </div>
      </div>
      <!-- /.row -->

 


      <div class="row">
        <div class="col-md-12">
         <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 id="response" class="box-title">CAM Summary</h3>
                <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>


            <div class="box-body">
              <table id="example" class="stripe row-border order-column" style="width:100%">
                <thead>
               
               <tr>
       
            
             <td>CAM</td>
             <td>Debtors</td>
             <td>Outsourced Amount</td>
             <td>Collected</td>
             <td>Written Off</td>
             <td>Disputed</td>
             <td>Handed Back</td>
            
            
                  
                </tr>
                </thead>
                <tbody>

                   <?php
  $sql = $app->getusersById();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
               

<tr>
   <td><a href="<?php echo 'pages/camdebtors.php?cam='. $row['id'] ?>" style="font-style: bold"><?php echo $row['firstname'] . ' ' . $row['lastname'];?></a></td>
  <td><?php echo $app->d_debtors($row['id']);?></td>
  <td><?php echo 'K '.number_format($app->d_outsourced($row['id']));?></td>
  <td><?php echo 'K '.number_format($app->d_collected($row['firstname']));?></td>
  <td><?php echo 'K '.number_format($app->d_write_off($row['id']));?></td>
  <td><?php echo 'K '.number_format($app->d_disputed($row['id']));?></td>
  <td><?php echo 'K '.number_format($app->d_handback($row['id']));?></td>

            
                </tr>
              <?php } ?>

                </tbody>
                
              </table>


            </div>
          </div>
        </div>
      </div>
    </div>



<!-- 
          <div class="row">
              <div class="col-md-12">
 
          <div class="box box-info">
                        <div class="box-header with-border">

            <h5><b><span>Performance on collections : </span><span style="color: #14bdf3"><?php echo $app->getbookcollected();?></span></b></h5>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                          
                                          </div>
                          </div>
                          <div class="box-body">
                            <div class="chart">
                              <canvas id="lineChartx" style="height:280px"></canvas>
                            </div>
                          </div>
         
          </div>
      
        </div>

      </div> -->



      <div class="row">
         <div class="col-md-12">
          <!-- LINE CHART -->
          <div style="border-color: #222D32;" class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Analysis</h3>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                          </div>
                          </div>


            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:320px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


<script>
        $(document).ready(function () {
            showGraph();

        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var type = [];
                     var number = [];
                     var value = [];
                     var debtors = parseInt($('#dbt').text());
                     var amount = parseInt($('#gbv').text());

                    

                    for (var i in data) {
                        type.push(data[i].type);
                        number.push(data[i].number / debtors * 100);
                        value.push(data[i].value / amount * 100);
                    }

                    var chartdata = {
                        labels: type,
                        datasets: [
                            {
                                label: 'Percentage of Debtors',
                                backgroundColor: '#d3d3d3',
                                borderColor: '#d3d3d3',
                                hoverBackgroundColor: '#d3d3d3',
                                hoverBorderColor: '#d3d3d3',
                                data: number

                            },
                             {
                                label: 'Percentage of Book Value',
                                backgroundColor: '#36454f',
                                borderColor: '#36454f',
                                hoverBackgroundColor: '#666666',
                                hoverBorderColor: '#666666',
                                data: value

                            }
                        ]
                    };

                    var graphTarget = $("#lineChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

        <script type="text/javascript">
          $(document).ready(function() {
    $('#example').DataTable( {
        scrollX: true,
        bFilter: false, 
        filter: true,
        bInfo: false,
        dom: 'Bfrtip',
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    } );
} );
        </script>
</body>
</html>
