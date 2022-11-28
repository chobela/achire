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
$did = $_GET['id'];

if(isset($_POST['status']))  {

  $status = $_POST['status'];
  echo $status;

    mysqli_query($db,"UPDATE debtors SET status = '$status' WHERE id = '$did'");

}


if (!isset ($_SESSION ['id']) && !isset ($_SESSION ['group']) && !isset ($_SESSION ['userid']) && !isset ($_SESSION ['firstname'])  && !isset ($_SESSION ['email'])) {

  header('Location: ../login.php');
 
 }
 
 $name = $_SESSION ['firstname'];

$app = new App;

$dsql = "SELECT *, debtors.email AS demail FROM debtors LEFT JOIN statuses ON statuses.id = debtors.status LEFT JOIN users ON debtors.kam = users.id WHERE debtors.id = '$did'";
$dresult = mysqli_query($db,$dsql);
$drow = mysqli_fetch_assoc($dresult);


$sumptpsql = "SELECT SUM(amount) AS sumptp FROM ptp WHERE debtorid = '$did' AND status = '1' OR status = '4' OR status = '6'";
$sumptpresult = mysqli_query($db,$sumptpsql);
$sumptprow = mysqli_fetch_assoc($sumptpresult);


include("paymentmodal.php");
include("commentmodal.php");
include("ptpmodal.php");
include("editptpmodal.php");

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

<style>

.loader{color:#fff;position:fixed;left:-9999px;top:-9999px;width:0;height:0;overflow:hidden;z-index:999999}.loader:after,.loader:before{box-sizing:border-box;display:none}.loader.is-active{background-color:transparent;width:100%;height:100%;left:0;top:0}.loader.is-active:after,.loader.is-active:before{display:block}.loader-bar[data-text]:before{top:calc(50% - 40px);color:#fff}.loader-bar:after{content:"";position:fixed;top:50%;left:50%;width:200px;height:20px;transform:translate(-50%,-50%);background:linear-gradient(-45deg,#4183d7 25%,#52b3d9 0,#52b3d9 50%,#4183d7 0,#4183d7 75%,#52b3d9 0,#52b3d9);background-size:20px 20px;box-shadow:inset 0 10px 0 hsla(0,0%,100%,.2),0 0 0 5px rgba(0,0,0,.2);animation:moveBar 1.5s linear infinite reverse}.loader-bar[data-rounded]:after{border-radius:15px}.loader-bar[data-inverse]:after{animation-direction:normal}@keyframes moveBar{0%{background-position:0 0}to{background-position:20px 20px}}

</style>
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

      <div class="row">
        
        <div class="col-md-6">
            <h3 id="dname" class="pull-left"><?php echo $drow['name'];?></h3>

        </div>
        
           <div class="col-md-6">
                    <h4 class="pull-right"> 
                      Balance : <span style="color: red;"><?php 

                $balance = $drow['owing'] - ($drow['write_off'] + $drow['dispute'] + $drow['handed_back'] + $drow['collected']);

              echo 'K '. number_format($balance,2);?></span>
            </h4>
            </div>
        
  <div class="col-md-6">
   <!-- <input class="pull-right" id="user" type="hidden"><?php echo $_SESSION['id'] ?>-->
       <!--<h5 class="pull-right" id="dref"><?php echo $drow['ref'];?></h5>-->
    </div>
      </div>
     
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">

    <div id="loading" class="loader loader-bar is-active"></div>
   
<div class="col-md-8">

 <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Contact Details</h3> 

<div class="pull-right" >
     <a type="button" style="margin-right:5px;" href="mailto:<?php echo $drow['demail'];?>?subject=Debt Collection&body=Dear <?php echo $drow['name'];?>" id="<?php echo $row['did']?>" name="msms"  class="btn btn-default btn-md">
      <span class="fa fa-envelope" aria-hidden="true"></span> 
    </a>
    
     <a type="button" style="margin-right:5px;" href="twilio/index.php?number=<?= $drow['phone'];?>&kam=<?=$name?>&did=<?=$did?>" class="btn btn-default  btn-md">
      <span class="fa fa-phone" aria-hidden="true"></span> 
    </a>

     <a type="button" style="margin-right:5px;" href="mysms.php?did=<?php echo $did?>&uid=<?php echo $id?>" id="<?php echo $row['did']?>" name="msms"  class="btn btn-default btn-md mdelete">
      <span class="fa fa-send" aria-hidden="true"></span> 
    </a>
    </div>
            </div>

             <div class="box-body">


              <div class="row">

                <div class="col-md-6">
                  <h5><span style="font-weight: bold;">CAM : </span><a id="kam" class="editable-select"><?php echo $drow['firstname'];?></a></h5>
                  
                </div>
                
                  <div class="col-md-6">
                  <h5><span style="font-weight: bold;">Next of Kin : </span><a id="next_kin" class="editable-text-full"><?php echo $drow['next_kin'];?></a></h5>
                </div>

              </div>

              <div class="row">

                <div class="col-md-6">
                  <h5><span style="font-weight: bold;">Employer : </span><a id="employer" class="editable-text-full"><?php echo $drow['employer'];?></a></h5> 
                </div>
                
                  <div class="col-md-6">
                  <h5><span style="font-weight: bold;">Next of Kin Phone : </span><a id="kin_phone" class="editable-text-full"><?php echo $drow['kin_phone'];?></a></h5>
                </div>

              </div>

            <div class="row">

              <div class="col-md-6">
                <h5 ><span style="font-weight: bold;">Phone : </span> <a id="phone" class="editable-text-full"><?php echo $drow['phone'];?></a></h5> 
              </div>
              
                <div class="col-md-6">
                <h5><span style="font-weight: bold;"> Address : </span> <a id="address" class="editable-text-full"><?php echo $drow['address'];?></a></h5>
              </div>

            </div>

            <div class="row">

              <div class="col-md-6">
                <h5><span style="font-weight: bold;">Email : </span><a id="email" class="editable-text-full"> <?php echo $drow['demail'];?></a></h5> 
              </div>
              
                <div class="col-md-6">
                <h5> <span style="font-weight: bold;">Town : </span><a id="town" class="editable-text-full"> <?php echo $drow['town'];?></a></h5>
              </div>

            </div>

            <div class="row">

              <div class="col-md-6">
                <h5> <span style="font-weight: bold;"> Uploaded on : </span> <?php echo $drow['uploaded_on'];?></h5> 
              </div>
              
               <div class="col-md-6">
                <h5> <span style="font-weight: bold;">NRC : </span><a id="nrc" class="editable-text-full"> <?php echo $drow['nrc'];?></a></h5>
              </div>
            </div>
          </div>
          
          </div>
          <!-- /.box -->
        </div>

   <div class="col-md-4">
          <!-- general form elements -->
     <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Status</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <?php
          $edit=mysqli_query($db,"select * FROM statuses");
          $erow=mysqli_fetch_array($edit);

          $scl = "SELECT * FROM statuses";
          $resc = mysqli_query($db,$scl);
           ?>
            <form role="form" method="POST" action="status.php">
              <div class="box-body">
                <div class="form-group">
                  <label>Status</label>

                <select  id="status" name="status" class="form-control select2" style="width: 100%;">
                  <option selected="selected" value=<?php echo $drow['status']?> ><?php echo $drow['type'] ?></option>
                    <?php 
                        foreach($resc as $r) { 
                          echo "<option value=\"$r[id]\">$r[type]</option>" ;
                        }
                    ?>
                </select>
                <input id="did" type="hidden" class="form-control" name="did" value="<?php echo $did;?>">
                <input id="ref" type="hidden" class="form-control" name="ref" value="<?php echo $drow['ref'];?>">
                 <input id="user" type="hidden" class="form-control" name="user" value="<?php echo $id;?>">
                  <input id="debtorname" type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name'];?>">
                </div>
               
              </div>
              <!-- /.box-body

$ref = $_POST['ref'];
$status = $_POST['status'];
$user = $_POST['user'];
$debtorname = $_POST['debtorname'];
               ------>

              <div class="box-footer">
                <button type="submit" class="btn bg-black pull-right">Save</button>
                 
                <div class="message_box" style="margin:10px 0px;"></div>
              </div>
            </form>
          </div>
        </div>
</div>   



  <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Promise To Pay</h3>
             <!--  <h5><span style="font-weight: bold;">Total Promised : </span><?php echo 'K '. number_format($sumptprow['sumptp'],2);?></h5> -->
             
              <button class="btn bg-black pull-right" href="#addptp" data-toggle="modal">Add PTP</button>

              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                    
                  <th>Amount Promised</th>
                  <th>Date Promised</th>
                  <th>Status</th>
                  <th>Updated By</th>
                  <th>Edit</th>
                  
            
                </tr>
                </thead>
                <tbody>

  <?php
        
        $query=mysqli_query($db,"SELECT ptp.*, ptpstatuses.ptptype, ptpstatuses.id AS pid FROM ptp JOIN ptpstatuses ON ptp.status = ptpstatuses.id  WHERE debtorid = '$did' ORDER BY id DESC");
        while($row=mysqli_fetch_array($query)){

          $ptpid = $row['id'];
          ?>
<tr>
          
                  <td><?php echo 'K '. number_format($row['amount'],2);?></td>
                  <td><?php 
                  $newDate = date("M jS, Y", strtotime($row['date']));
                  echo $newDate;?></td>

 <td><span class="pull-right-container">
                    
                    <?php if($row['status'] == '1'){

                      echo ' <small class="label bg-red">'. $row['ptptype'].'</small>';

                    } else if($row['status'] == '2') {

                      echo ' <small class="label bg-black">'. $row['ptptype'].'</small>';
                    } 
                    else if($row['status'] == '3') {

                      echo ' <small class="label bg-green">'. $row['ptptype'].'</small>';
                    }
                    else if($row['status'] == '4') {

                      echo ' <small class="label bg-orange">'. $row['ptptype'].'</small>';

                    }   else if($row['status'] == '5') {

                      echo ' <small class="label bg-green">'. $row['ptptype'].'</small>';
                    }else if($row['status'] == '6') {

                      echo ' <small class="label bg-blue">'. $row['ptptype'].'</small>';
                    }


                    ?>
             
            </span></td>

                   <td><?php echo $row['kam'];?></td>
                 <td>
              
    

  <a type="button" class="btn btn-default btn-md" href="editptp.php?ptpid=<?php echo $row['id'];?>&debtorname=<?= $drow['name'];?>&pid=<?=$row['pid'];?>&ptptype=<?=$row['ptptype'];?>&debtorid=<?=$row['debtorid'];?>">
    
      <span class="fa fa-edit" aria-hidden="true">
          
      </span> 
    </a>

                 </td>
                 
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->



     
  <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Payment History</h3>
              <h5><span style="font-weight: bold;">Outsourced Amount : </span><?php echo 'K '. number_format($drow['owing'],2);?></h5>
              <h5><span style="font-weight: bold;">Balance : </span><?php 

                $balance = $drow['owing'] - ($drow['write_off'] + $drow['dispute'] + $drow['handed_back'] + $drow['collected']);

              echo 'K '. number_format($balance,2);?></h5>
             
              <button class="btn bg-black pull-right" href="#addpayment" data-toggle="modal">Add Payment</button>

              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                    
                  <th>Amount Paid</th>
                  <th>Payment Date</th>
                  <th>Transaction Method</th>
                  <th>Manager</th>
                  <th>Status</th>
                  
            
                </tr>
                </thead>
                <tbody>

  <?php
        
        $query=mysqli_query($db,"SELECT payments.id, amount, status, date, kam, transtypes.type FROM payments JOIN transtypes ON payments.transtype = transtypes.id WHERE debtor_id = '$did' ORDER BY payments.id DESC");
        while($row=mysqli_fetch_array($query)){

          //ref kam client  account nrc name  employer  phone email next_kin  kin_phone address town  owing collected write_off status  uploaded_on
          ?>
<tr>
          
                  <td><?php echo 'K '. number_format($row['amount'],2);?></td>
                  <td><?php 
                  $newDate = date("M jS, Y", strtotime($row['date']));
                  echo $newDate;?></td>
                   <td><?php echo $row['type'];?></td>
                  <td><?php echo $row['kam'];?></td>
                  <td><span class="pull-right-container">
                    
                    <?php if($row['status'] == '1'){

                      echo ' <small class="label bg-green">Approved</small>';

                    } else {

                      echo ' <small class="label bg-red">Pending Approval</small>';

                    }?>
             
            </span></td>
                 
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->

<div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Comments</h3>
              <button class="btn bg-black pull-right" href="#addcomment" data-toggle="modal">Add Comment</button>
             
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="examplec" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                    
                  <th>Comment</th>
                  <th>Date</th>
                  <th>CAM</th>
            
                </tr>
                </thead>
                <tbody>

 <?php
        
        $query=mysqli_query($db,"SELECT * FROM comments WHERE did = '$did' ORDER BY date DESC");
        while($row=mysqli_fetch_array($query)){

          //ref kam client  account nrc name  employer  phone email next_kin  kin_phone address town  owing collected write_off status  uploaded_on
          ?>
<tr>
          
                  <td><?php echo $row['comment'];?></td>
                  <td><?php 
                  $newDate = date("M jS, Y", strtotime($row['date']));
                  echo $newDate;?></td>
                  <td><?php echo $row['kam'];?></td>
                 
                  
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->


         <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Debtor Documents</h3>


 <form action="files.php" method="POST"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
         <div class="box-header pull-left">


<input id="debtorid" type="hidden" class="form-control" name="debtorid" value="<?php echo $_GET['id']?>">
 <input type="file" name="file">
  <input type="hidden" class="form-control" name="debtorname" value="<?php echo $drow['name']?>">
  <input type="hidden" class="form-control" name="user" value="<?php echo $id?>">

                                   
          </div>
               
            <div class="box-header pull-right">



              <button type="submit" id="submit" name="import" class="btn bg-black btn-sm">Upload File</button>
<div class="message_box" style="margin:10px 0px;">
                
            </div>
            </form>  

            
             
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="examplef" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                    
                  <th>Filename</th>
                  <th>Date</th>
            
                </tr>
                </thead>
                <tbody>

  <?php
        
        $query=mysqli_query($db,"SELECT filename, path FROM files WHERE did = '$did' ORDER BY id DESC");
        while($row=mysqli_fetch_array($query)){

         
          ?>
<tr>
               
                  <td><?php echo $row['filename'];?></td>
                  <td><a href="<?php echo $row['path'];?>">View File </a></td>
             
                          
                </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->
</form>
</div>

<div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">SMS History</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="smstable" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                  <th>Sent By</th>
                  <th>Message sent</th>
                  <th>Sent to</th>
                  <th>Status</th>
                  <th>Sent On</th>
            
                </tr>
                </thead>
                <tbody>

 <?php
        
        $query=mysqli_query($db,"SELECT * FROM sentmessages WHERE debtorid = '$did'");
        while($row=mysqli_fetch_array($query)){

          ?>
              <tr>
                  <td><?php echo $row['user'];?></td>
                  <td><?php echo $row['message'];?></td>
                   <td><?php echo $row['number'];?></td>
                   <td>
                     <?php
                      switch ($row['poststatus']) {
                        case ('1701'):
                           $status = 'Message Delivered';
                          break;
                        case ('1702'):
                          $status = 'Failed : Parameter missing';
                          break;
                        case ('1703'):
                           $status = 'Failed : Invalid username and password';
                          break;
                          case ('1704'):
                           $status = ' Failed : Invalid message type';
                          break;
                           case ('1705'):
                           $status = 'Failed : Invalid message';
                          break;
                           case ('1706'):
                           $status = 'Failed : Invalid Destination';
                          break;
                           case ('1707'):
                           $status = 'Failed : Invalid Sender ID';
                          break;
                           case ('1708'):
                           $status = 'Failed : Invalid Dir Value';
                          break;
                           case ('1709'):
                           $status = 'User Validation failed';
                          break;
                           case ('1710'):
                           $status = 'Failed : Internal error.';
                          break;
                            case ('1715'):
                           $status = 'Failed : Response timeout.';
                          break;
                            case ('1025'):
                           $status = 'Failed : Insufficient credit.';
                          break;
                             case ('1032'):
                           $status = 'DND reject.';
                          break;
                             case ('1028'):
                           $status = 'Spam message.';
                          break;
                        }
                        echo $status;
                     ?>
                   </td>
              
              <td><?php echo $row['sent_on'];?></td>
              </tr>

                         <?php
        }
      ?>
                
                </tbody>
               
              </table>
                
            </div>
          
          </div>
          <!-- /.box -->


          <div style="border-color: #222D32;" class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Call History</h3>
              
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
             <table id="smstable" class="table table-bordered table-striped">
                <thead>
                <tr>

                 <!-- <th><input type="checkbox" id="master"></th>-->
                  <th>Debtor</th>
                  <th>KAM</th>
                  <th>Call Status</th>
                  <th>Call Date/Time</th>
                  <th>Number Called</th>
               
                  
                </tr>
                </thead>
                <tbody>

 <?php
        
        $query=mysqli_query($db,"SELECT calls.*, debtors.name FROM calls JOIN debtors ON calls.debtorid = debtors.id WHERE calls.kam = '$name' ORDER BY datetime DESC");

        while($row=mysqli_fetch_array($query)){

          ?>
              <tr>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['kam'];?></td>
                  <td><?php echo $row['callstatus'];?></td>
                   <td><?php echo $row['datetime'];?></td>
                  <td><?php echo $row['numbercalled'];?></td>
                 
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
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jeditable.js/2.0.19/jquery.jeditable.min.js"></script>

<script type="text/javascript">
  $("#loading").hide();  
  
  
</script>

<script type="text/javascript">
  
  function myptp() {
    location.replace("ptp.php?did=<?php echo $did?>");
  }
</script>

<script type="text/javascript">

  $(document).ready(function(){
  
/* data that will be sent along */
var submitdata = {}
/* this will make the save.php script take a long time so you can see the spinner ;) */
submitdata['slow'] = true;
submitdata['debtor'] = getUrlParameter('id');


// inline select
$(".editable-select").editable("save.php", {
    type   : "select",
    // this data will be sorted by value
    loadurl : "json.php",
    submitdata : submitdata,
    cancel : 'Cancel',
    cssclass : 'custom-class',
    cancelcssclass : 'btn btn-danger btn-xs',
    submitcssclass : 'btn btn-success btn-xs',
    submit : 'Save',
    maxlength : 200,
    select : true,
    showfn : function(elem) { elem.fadeIn('slow') },
    width : 100,

    callback : function(result, settings, submitdata) {
        location.reload();
    },
});


$(".editable-text-full").editable("save.php", {
    indicator : "<img src='img/svg-loaders/rings.svg' />",
    type : "text",

    callback : function(result, settings, submitdata) {
        /*console.log('Triggered after submit');
        console.log('Result: ' + result);
        console.log('Settings.width: ' + settings.width);
        console.log('Submitdata: ' + submitdata.debtor);*/

    },
    cancel : 'Cancel',
    cssclass : 'custom-class',
    cancelcssclass : 'btn btn-danger btn-xs',
    submitcssclass : 'btn btn-success btn-xs',
    maxlength : 200,
    // select all text
    select : true,
    //label : 'Edit',
    showfn : function(elem) { elem.fadeIn('slow') },
    submit : 'Save',
    submitdata : submitdata,
    /* submitdata as a function example
    submitdata : function(revert, settings, submitdata) {
        console.log("Revert text: " + revert);
        console.log(settings);
        console.log("User submitted text: " + submitdata.value);
    },
    */
    tooltip : "Click to edit...",
    width : 160
   });

   function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};


 });
</script>


    <script type="text/javascript">


$(document).ready(function() {
    $('#smstable, #examplef, #examplec, #example').DataTable( {
        bSort:false,
        pageLength: 3,
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

    <script>
$(document).ready(function() {
   var delay = 2000;
   
   $('#btn-status').click(function(e){

   e.preventDefault();

   var status = $('#status option:selected').val();
   var ref = $('#dref').text();
   var user = $('#user').val();
   var debtorname = $('#dname').text();
  

 
                 $.ajax
                         ({
                         type: "POST",
                         url: "status.php",

                         //data: "status="+status+"&ref="+ref,
                          data: {status:status, ref:ref, user:user, debtorname:debtorname},

                         beforeSend: function() {
                         $("#loading").show(); 
                         },

                         success: function(response)
                         {


                               setTimeout(function() {

                                   $("#loading").hide(); 
                         //$("#success").show(); 
                         console.log(response)

                        
                    
                           }, delay);        
                         }
                   });
            });
});
</script>
<script>
 //Date picker
    $('#mydate').datepicker({
      autoclose: true
    })
</script>

<script>
 //Date picker
    $('#nextdate').datepicker({
      autoclose: true
    })
</script>

<script>
 //Date picker
    $('#ptpdate').datepicker({
      autoclose: true
    })
</script>


    <script type="text/javascript">
        $("#clickme").click(function () {
        console.log($("#clickme").val());
        });
    </script>

</body>
</html>