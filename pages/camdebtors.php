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
$kam = $_GET['cam'];


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }
 
 $name = $_SESSION ['firstname'];

$app = new App;

?>

<?php

$message = 'Detbtors';

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");

        $today = date('Y-m-d');

     
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into debtors (ref, kam, client, account, nrc, name, employer, phone, email, next_kin, kin_phone, address, town, owing, collected, write_off, status, uploaded_on)
                   values ('" . $column[0] . "', '" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','" . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "','" . $column[14] . "','" . $column[15] . "','" . $column[16] . "', '$today')";
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
       Detbtors
        
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
                  <th>Ref</th>
                  <th>Client</th>
                  <th>Name</th>          
                  <th>Outsourced</th>
                  <th>Collected</th>
                  <th>Written Off</th>
                  <th>Disputed</th>
                  <th>Handed Back</th>
                  <th>Balance</th>
                  
                 

                </tr>
                </thead>
                <tbody>

  <?php
  $id = $_SESSION['id'];
  $group = $_SESSION['group'];
        
  

$query=mysqli_query($db,"SELECT *, debtors.id AS did FROM debtors LEFT JOIN clients ON debtors.client = clients.id LEFT JOIN statuses ON debtors.status = statuses.id LEFT JOIN users ON debtors.kam = users.id WHERE debtors.kam = '$kam'");

       function convertCurrency($amount, $currency){
        return 'K '. number_format($amount,2);

/*
                if($currency === 'ZMW'){

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
<tr id="<?php echo $row["did"]; ?>">
                  <td><input type="checkbox" class="emp_checkbox" data-did="<?php echo $row["did"]; ?>"></td>
                   <td><?php echo $row['ref'];?></td>
                   <td><?php echo $row['clientname'];?></td>
                   <td><a href="<?php echo 'singledebtor.php?id='.$row['did']?>"><?php echo $row['name'];?></a></td>
                  
                   <td><?php echo convertCurrency($row['owing'], $row['currency']); ?></td>
                   <td><?php 

                     if(empty($row['collected'])){

                         echo 'K 0.00';

                    } else {
                         echo convertCurrency($row['collected'], $row['currency']);
                    }

                    ?></td>
                   <td><?php 

                     if(empty($row['write_off'])){

                         echo 'K 0.00';

                    } else {
                         echo convertCurrency($row['write_off'], $row['currency']);
                    }

                    ?></td>
                   <td><?php 

                     if(empty($row['disputed'])){

                         echo 'K 0.00';

                    } else {
                         echo convertCurrency($row['disputed'], $row['currency']);
                    }

                    ?></td>
                   <td><?php 

                     if(empty($row['handed_back'])){

                         echo 'K 0.00';

                    } else {
                          echo convertCurrency($row['handed_back'], $row['currency']);
                    }

                    ?></td>
                    <td><?php 
                    
                    $balance = $row['owing'] - ($row['collected'] + $row['write_off'] + $row['disputed'] + $row['handed_back']);

                    echo convertCurrency($balance, $row['currency']);
                    
                    ?></td>
                
                  
                  
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
 <?php
 include ('scripts.html');
 ?>

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
            WRN_PROFILE_DELETE = "Are you sure you want to delete "+(employee.length>1?"these":"this")+" debtors?";  
            var checked = confirm(WRN_PROFILE_DELETE);  
            if(checked == true) {           
                var selected_values = employee.join(","); 
                $.ajax({ 
                    type: "POST",  
                    url: "delete_action.php",  
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