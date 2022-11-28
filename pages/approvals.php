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

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


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
       Approvals
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

     


<div style="border-color: #222D32;" class="box">
            <div class="box-header">
              
              <h3 id="response" class="box-title"><?php echo $message?></h3>
        
            </div>

           <div id="loading" class="loader loader-bar is-active"></div>
                
         
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                      
                  <th><input type="checkbox" id="select_all"></th>
                  <th>CAM</th>
                  <th>Debtor</th>
                  <th>Amount</th>
                  <th>Type</th> 
                  <th>Entry Date</th>
                  <th>Next Payment</th>                   
                  <th>Approval</th>
                 

                </tr>
                </thead>
                <tbody>

  <?php
  $id = $_SESSION['id'];
  $group = $_SESSION['group'];
        
  
        $query=mysqli_query($db,"SELECT *, paytypes.type AS ptype, paytypes.id AS ptype_id, payments.kam AS kkam, payments.status AS sstatus, payments.id AS pay_id, payments.nextdate, debtors.currency FROM payments JOIN paytypes ON payments.type = paytypes.id JOIN debtors ON payments.debtor_id = debtors.id ORDER BY payments.status ASC");

        function debtorname($debtor){

            global $db;

            $result = mysqli_query($db,"SELECT name FROM debtors WHERE id = '$debtor'");
        
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);

            return $res['name'];
        }


       function convertCurrency($amount, $currency){

        return 'K '. number_format($amount,2);


           /*     if($currency === 'ZMW'){

                    return 'K '. number_format($amount,2);

                } else {

                  $apikey = 'cf0be1359d22db08da65';

                  $from_Currency = urlencode('USD');
                  $to_Currency = urlencode('ZMW');
                  $query =  "{$from_Currency}_{$to_Currency}";

                  // change to the free URL if you're using the free version
                  $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

                  $obj = json_decode($json, true);

                  $val = floatval($obj["$query"]);


                  $total = $val * $amount;
            

                return 'K '. number_format($total,2);
                }*/

            
}

        while($row=mysqli_fetch_array($query)){

   

          ?>

                 <tr id="<?php echo $row["pay_id"]; ?>">
                    <td><input type="checkbox" class="emp_checkbox" data-did="<?php echo $row["pay_id"]; ?>"></td>
                   <td><?php echo $row['kkam'];?></td>

                   <td><a href="singledebtor.php?id=<?php echo $row['debtor_id'];?>" style="cursor: pointer;"><?php echo debtorname($row['debtor_id']);?></a></td>

                    <td><?php echo convertCurrency($row['amount'], $row['currency']);?></td>

                    <td><?php echo $row['ptype'];?></td>

                      <td><?php echo date('d/m/Y',strtotime($row['date']));?></td>

                        <td><?php echo date('d/m/Y',strtotime($row['nextdate']));?></td>

                    <td><input type="checkbox" <?php if ($row['sstatus']) {
                      // code...
                      echo "checked";

                    } ?> data-toggle="toggle" data-size="small" data-onstyle="success" data-on="Approved" data-off="Pending" pay_id="<?php  echo $row['pay_id'];?>" debtor_id="<?php  echo $row['debtor_id'];?>" myamount="<?php  echo $row['amount'];?>" ptype="<?php  echo $row['ptype_id'];?>" status="<?php  echo $row['sstatus'];?>" ></td>
                   
                 
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
               <div class="col-md-2 well">
                        <span class="rows_selected" id="select_count">0 Selected</span>
                        <a type="button" id="delete_records" class="btn bg-black pull-right <?php if ($group != '1'){ echo 'disabled';}?>">Delete</a>
                    </div>
                
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

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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

        $(document).ready(function() {
            $("#example").on('change', 'input[type="checkbox"]', function(){


                        var status = $(this).attr("status");
                        var pay_id = $(this).attr("pay_id");
                        var ptype = $(this).attr("ptype");
                        var debtor_id = $(this).attr("debtor_id");
                        var myamount = $(this).attr("myamount");

                       
                        // AJAX Code To Submit Form.
                        $.ajax({
                        type: "POST",
                        url: "approve.php",
                         data: {
                          status:status, 
                          pay_id:pay_id, 
                          ptype:ptype, 
                          debtor_id:debtor_id, 
                          myamount:myamount},
                        cache: false,
                        success: function(result){

                        var res = JSON.parse(result);

                      
                          if (res.resp == '1') {

                      
                               //  window.location.reload();
                          

                          } else {

                   
                          }
                    }

                 });
            });
        });
    </script>

    <script type="text/javascript">
  $("#loading").hide();  
</script>



  <script type="text/javascript">
      
$('document').ready(function() {
    // select all checkbox  
    $(document).on('click', '#select_all', function() {             
        $(".emp_checkbox").prop("checked", this.checked);
        $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
    }); 
    $(document).on('click', '.emp_checkbox', function() {       
        if ($('.emp_checkbox:checked').length == $('.emp_checkbox').length) {
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
        $("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
    });  
    // delete selected records
    jQuery('#delete_records').on('click', function(e) { 
        var employee = [];  
        $(".emp_checkbox:checked").each(function() {  
            employee.push($(this).data('did'));
        }); 
        if(employee.length <=0)  {  
            alert("Please select debtors.");  
        }  
        else {  
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(employee.length>1?"these":"this")+" payments?";  
            var checked = confirm(WRN_PROFILE_DELETE);  
            if(checked == true) {           
                var selected_values = employee.join(","); 
                $.ajax({ 
                    type: "POST",  
                    url: "delete_payment.php",  
                    cache:false,  
                    data: 'emp_id='+selected_values,  
                    success: function(response) {   
                        // remove deleted employee rows
                        // var emp_ids = response.split(",");
                        // for (var i=0; i<emp_ids.length; i++ ) {                     
                        //     $("#"+emp_ids[i]).remove();
                        // } 
                         location.reload();                                      
                    }   
                });             
            }  
        }  
    });
});

  </script>

</body>
</html>