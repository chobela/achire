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
        Clients
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

 <div style="border-color: #222D32;" class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title">Client Summary</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th colspan="1">Client</th>
                  <th colspan="1">Outsourced</th>
                  <th colspan="1">Collected</th>
                  <th colspan="1">Outstanding</th>        
                  <th colspan="2">Disputes</th>
                  <th colspan="2">Legal</th>
                  <th colspan="2">Settled</th>
                  <th colspan="2">Active</th>
                  <th colspan="2">Skip/Trace</th>
                
                  
                </tr>
               <tr>
       
                  <th></th>
                    <th></th>
                  <th></th>
                   <th></th>
                  <th></th>
                  <th>Collected</th>
                   <th></th>
                  <th>Collected</th>
                   <th></th>
                  <th>Collected</th>
                    <th></th>
                  <th>Collected</th>
                    <th></th>
                  <th>Collected</th>
                  
                  
                </tr>
                </thead>
                <tbody>

  <?php
        
        $query=mysqli_query($db,"SELECT * FROM clients");
        while($row=mysqli_fetch_array($query)){

          //ref kam client  account nrc name  employer  phone email next_kin  kin_phone address town  owing collected write_off status  uploaded_on
          ?>
<tr>
             <!--Client Name-->
              <td><a href="<?php echo 'clientdebtors.php?id='. $row['id'] ?>" style="font-style: bold"><?php echo $row['clientname'];?></a></td>

               <td><?php echo $app->getoutsourced($row['id']);?></td>
            <td><?php echo $app->getcollected($row['id']);?></td>
            <td><?php echo $app->getoutstanding($row['id']);?></td>
            
            <td><?php echo $app->getdisputes($row['id']);?></td>
            <td><p
            <?php if ($app->sumdisputes($row['id']) == 'K 0.00') {
            echo 'class="text-red"';
            } else {
            echo 'class="text-green"';
            }?>
            ><?php echo $app->sumdisputes($row['id']);?></p></td>
            <td><?php echo $app->getlegal($row['id']);?></td>
             <td><p
            <?php if ($app->sumlegal($row['id']) == 'K 0.00') {
            echo 'class="text-red"';
            } else {
            echo 'class="text-green"';
            }?>
            ><?php echo $app->sumlegal($row['id']);?></td>
            <td><?php echo $app->getsettled($row['id']);?></td>
            <td><p
            <?php if ($app->sumsettled($row['id']) == 'K 0.00') {
            echo 'class="text-red"';
            } else {
            echo 'class="text-green"';
            }?>
            ><?php echo $app->sumsettled($row['id']);?></td>
            <td><?php echo $app->getactive($row['id']);?></td>
            <td><p
            <?php if ($app->sumactive($row['id']) == 'K 0.00') {
            echo 'class="text-red"';
            } else {
            echo 'class="text-green"';
            }?>
            ><?php echo $app->sumactive($row['id']);?></td>
            <td><?php echo $app->getskiptrace($row['id']);?></td>
             <td><p
            <?php if ($app->sumskiptrace($row['id']) == 'K 0.00') {
            echo 'class="text-red"';
            } else {
            echo 'class="text-green"';
            }?>
            ><?php echo $app->sumskiptrace($row['id']);?></td>
           
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
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

 <?php
 include ('scripts.html');
 ?>

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