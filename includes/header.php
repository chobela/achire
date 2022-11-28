
<header class="main-header">
<!-- Logo -->
<a <?php 

$self = $app->getself();

if ($_SERVER['PHP_SELF'] == $self) {

  echo 'href="index.php"';

} else {
 echo 'href="../index.php"';

}

 ?>  class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini">Achire</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b><?php echo $app->getappname();?></b> Admin</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar navbar-fixed-top skin-green">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

 <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
<!--         <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-send-o"></i>
              <span class="label label-default">549</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 549 SMSs Available</li>
          
             
            </ul>
          </li> -->

         <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calendar"></i>
              <span class="label label-primary"><?= $app->countevents();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?php echo $app->countevents();?> event(s) today</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
          

                  <?php
                  $sql = $app->getevents();
                  while($row=mysqli_fetch_array($sql))  
                  {
                  ?>
                  <li>
                    <a href="calendar.php">
                       <i class="fa fa-calendar text-grey"></i> <?= $row['title'];?>
                    </a>
                  </li>
                  <?php } ?>
                 
                </ul>
              </li>
             
            </ul>
          </li>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success"><?= $app->countptps();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?= $app->countptps();?> PTP(s) Due Today</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
       
                   <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                                
                  <?php
                    $sql = $app->getptps();
                    while($row=mysqli_fetch_array($sql))
                    {
                  ?>
                  <li>
                    <a href="pages/singledebtor.php?id=<?php echo $row['debtorid'];?>">
                      <i class="fa fa-bell-o text-grey"></i>  <?php echo $row['name'].' - '. 'K '.number_format($row['amount'],2); ?>
                    </a>
                  </li>
                  
                  <?php } ?>
                 
                </ul>
              </li>
                 
                </ul>
              </li>
             
            </ul>
          </li>
           <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-warning"></i>
              <span class="label label-danger"><?= $app->countbrokenptps();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><?= $app->countbrokenptps();?> Broken Promise(s)</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                     <?php
                        $sql = $app->getbrokenptps();
                        while($row=mysqli_fetch_array($sql))
                        {
                        ?>
                      <li>
                        <a href="pages/singledebtor.php?id=<?php echo $row['debtorid'];?>">
                          <i class="fa fa-warning text-grey"></i>  <?php echo $row['name'].' - '. 'K '.number_format($row['amount'],2); ?>
                        </a>
                      </li>
                  <?php } ?>
                 
                </ul>
              </li>
             
            </ul>
          </li>

    <li><a  href="includes/logout.php" class="fa fa-power-off"> Sign out</a></li>
     
    </ul>
  </div>
</nav>
</header>
