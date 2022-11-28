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


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['userid']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }
 
 $name = $_SESSION ['firstname'];

$app = new App;

?>

<?php

$message = 'Upload Files';

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into numbers (number, userid)
                   values ('" . $column[0] . "','$userid')";
            $result = mysqli_query($db, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database!";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
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
<style>

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

.loader{color:#fff;position:fixed;left:-9999px;top:-9999px;width:0;height:0;overflow:hidden;z-index:999999}.loader:after,.loader:before{box-sizing:border-box;display:none}.loader.is-active{background-color:transparent;width:100%;height:100%;left:0;top:0}.loader.is-active:after,.loader.is-active:before{display:block}.loader-bar[data-text]:before{top:calc(50% - 40px);color:#fff}.loader-bar:after{content:"";position:fixed;top:50%;left:50%;width:200px;height:20px;transform:translate(-50%,-50%);background:linear-gradient(-45deg,#4183d7 25%,#52b3d9 0,#52b3d9 50%,#4183d7 0,#4183d7 75%,#52b3d9 0,#52b3d9);background-size:20px 20px;box-shadow:inset 0 10px 0 hsla(0,0%,100%,.2),0 0 0 5px rgba(0,0,0,.2);animation:moveBar 1.5s linear infinite reverse}.loader-bar[data-rounded]:after{border-radius:15px}.loader-bar[data-inverse]:after{animation-direction:normal}@keyframes moveBar{0%{background-position:0 0}to{background-position:20px 20px}}

</style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

      $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
              $("#response").addClass("error");
              $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
  

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
        Uploads
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

     


 <div class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title"><?php echo $message?></h3>
              
            </div>

           <div id="loading" class="loader loader-bar is-active"></div>
                

 <form action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
         <div class="box-header pull-left">


<input type="file" name="file" id="file" accept=".csv">
                                   
          </div>
               
        
            <div class="box-header pull-right">



              <button type="submit" id="submit" name="import" class="btn btn-success btn-sm">Upload File</button>

                 <button type="submit" method="GET" action="sample.xls" class="btn btn-success btn-sm">Download Sample sheet</button>
            
                <button type="button" href="#addnew" data-toggle="modal" class="btn btn-success btn-sm">Add Single Number</button>

              <button type="button" class="btn btn-danger btn-sm delete_all">Delete</button>
                
            </div>
            </form>  
         
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>

                  <th><input type="checkbox" id="master"></th>
                  <th>Client phone</th>


                 
                </tr>
                </thead>
                <tbody>

  <?php
        
        $query=mysqli_query($db,"SELECT * FROM numbers");
        while($row=mysqli_fetch_array($query)){
          ?>

                <tr data-row-id="<?php echo $row['id'];?>">
                   <td><input type="checkbox" class="sub_chk" data-id="<?php echo $row['id'];?>"></td>
                   <td><?php echo $row['number'];?></td>
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
            <?php include('add_modal.php'); ?>
            <!-- /.box-body -->
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
        bFilter: true, 
        filter: true,
        bInfo: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

    </script>
 
  <script type="text/javascript">  
 jQuery('#master').on('click', function(e) {
  if($(this).is(':checked',true))  
  {
    $(".sub_chk").prop('checked', true);  
  }  
  else  
  {  
    $(".sub_chk").prop('checked',false);  
  }  
});
  </script>

  <script type="text/javascript">
    jQuery('.delete_all').on('click', function(e) { 
var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      $("#loading").show(); 
      WRN_PROFILE_DELETE = "You are about to delete the seclected rows";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        //for server side
        
        var join_selected_values = allVals.join(","); 
        
        $.ajax({   
          
          type: "POST",  
          url: "deletenumber.php",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $("#loading").hide();  
            $("#response").html(response);
            //referesh table
   $.each(allVals, function( index, value ) {
          $('table tr').filter("[data-row-id='" + value + "']").remove();
        });  
          }   
        });
             
        

      }  
    }  
  });

  </script>



</body>
</html>