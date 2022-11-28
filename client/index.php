<?php
include('../config.php');
$linkid = $_GET['link'];

$sql = "SELECT debtorid, kam FROM momolinks WHERE link_id = '$linkid'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);



?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Achire Business Support</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
  
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Achire Business Support</h2>
                </div>

                <div class="card-body">
                    <form action="../pages/formposts.php" enctype="multipart/form-data" method="POST" >
        
                 

                         <div class="form-row">
                            <div class="name">Amount</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="amount">
                                </div>
                            </div>
                        </div>

                

                        <div class="form-row m-b-55">
                            <div class="name">Mobile Money Phone</div>
                            <div class="value">
                                <div class="row row-refine">
                                    <div class="col-3">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="number" value="260" name="area_code">
                                            <label class="label--desc">Area Code</label>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="number" name="phone">
                                            <label class="label--desc">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="name">Comment (Optional)</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="comment">
                                </div>
                            </div>
                        </div>

            
                        <div class="form-row p-t-20">
                            <label class="label label--block">Do you agree to the Payment Terms and conditions?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                          <input type="hidden" name="mm_insert" class="form-control" id="mm_insert" value="clientpay">
                          <input type="hidden" name="debtorid" class="form-control" id="debtorid" value="<?= $row['debtorid']; ?>">
                          <input type="hidden" name="kam" class="form-control" id="kam" value="<?= $row['kam']; ?>">
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Pay</button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->