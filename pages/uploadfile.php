.<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
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

if (isset($_POST["book"]) && isset($_POST["clientname"])) {

   $client = $_POST["clientname"];

   $sqlInsert = "INSERT INTO clients (clientname) VALUES ('$client')";
   mysqli_query($db, $sqlInsert);
   header('location:uploadfile.php');
}

if (isset($_POST["import"]) && isset($_POST["kam"]) && isset($_POST["client"])) {
  
    $kam = $_POST["kam"];
    $client = $_POST["client"];

    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into debtors (ref, kam, client, account, nrc, name, employer, phone, email, next_kin, kin_phone, address, town, owing, collected, write_off, disputed, handed_back, currency, status, uploaded_on)
                   values ('" . $column[0] . "', '".$kam."', '".$client."', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '" . $column[4] . "', '" . $column[5] . "', '" . $column[6] . "', '" . $column[7] . "', '" . $column[8] . "', '" . $column[9] . "', '" . $column[10] . "', '" . $column[11] . "', '" . $column[12] . "', '" . $column[13] . "', '" . $column[14] . "', '" . $column[15] . "', '" . $column[16] . "', '" . $column[17] . "', CURDATE())";
            $result = mysqli_query($db, $sqlInsert);
            
            if (! empty($result)) {
                header('location:debtors.php');
            } else {
                echo 'An error occured';
            }
        }
    }
}

                
$scl = "SELECT id, firstname FROM users WHERE groupe > 1";
$resc = mysqli_query($db,$scl);

$s = "SELECT id, clientname FROM clients ORDER BY clientname ASC";
$cc = mysqli_query($db,$s);
        

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
        Debt Book
      
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
         
 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
         <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Debt Book</h3>
              <a class="pull-right" href="test.csv" download="test.csv">Download Sample File</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
              <div class="box-body">

                   <div class="form-group">
                  <label for="sendername">Client</label>
                      <select  id="client" name="client" class="form-control select2" style="width: 100%;">
                         <option value='Select'>Select</option>
                    <?php 
                        foreach($cc as $c) { 
                          echo "<option value=\"$c[id]\">$c[clientname]</option>" ;
                        }
                    ?>
                </select>

                </div>

                  <div class="form-group">
                  <label for="kam">Account Manager</label>
                <select  id="kam" name="kam" class="form-control select2" style="width: 100%;">
                  <option value='Select'>Select</option>
                    <?php 
                        foreach($resc as $r) { 
                          echo "<option value=\"$r[id]\">$r[firstname]</option>" ;
                        }
                    ?>
                </select>
                </div>

              

            <div class="form-group">
                  <label for="sendername">File</label>
               <input type="file" name="file" id="file" accept=".csv">
             </div>

               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit" name="import" class="btn bg-black pull-right">Save</button>
              </div>
            </form>

          </div>

       </div>

        <div class="col-md-6">
          <!-- general form elements -->
          <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Client</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
              <div class="box-body">

                   <div class="form-group">
                  <label for="sendername">Client Name</label>
                     
                      <input class="form-control" id="clientname" name="clientname" placeholder="Client Name">

                </div>


               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submit" name="book" class="btn bg-black pull-right">Save</button>
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

 <?php
 include ('scripts.html');
 ?>


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