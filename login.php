<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require("App.php");
$app = new App;


 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $username = $_POST['username'];
      $password = $_POST['password'];

      $loggedin = $app->login($username,$password);


      if($loggedin == '1'){

      $user = $app->getUser($username,$password);

      session_unset();
      session_start();

       $_SESSION['id'] = $user['id'];
       $_SESSION['username'] = $user['username'];
       $_SESSION['password'] = $user['password'];
       $_SESSION['firstname'] = $user['firstname'];
       $_SESSION['lastname'] = $user['lastname'];
       $_SESSION['email'] = $user['email'];
       $_SESSION['phone'] = $user['phone'];
       $_SESSION['group'] = $user['groupe'];
         
     $app->sendaction('1', $user['id'], "Logged in");
      header("location: index.php");
      }

      echo '<strong>Username or Password is invalid</strong>';
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title>
    Achire Login
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="css/nucleo-icons.css" rel="stylesheet" />
  <link href="css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
    
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your username and password to sign in</p>
                </div>
                <div class="card-body">
                  <form role="form" action="" method="POST">
                    <div class="mb-3">
                      <input type="text" name="username" class="form-control form-control-lg" placeholder="Usermane" aria-label="Username">
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-dark btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
               <!--  <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="#" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div> -->
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('img/achire.png');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
               <!--  <h4 class="mt-5 text-white font-weight-bolder position-relative">Debt Management System</h4> -->
                <!-- <p class="text-white position-relative">"An Effortless and Quality Dashboard for your Daily Operations"</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.min.js"></script>
  <script src="js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/argon-dashboard.min.js?v=2.0.0"></script>
</body>

</html>