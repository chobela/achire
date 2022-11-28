<?php include("welcome.php");?>  
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

<?php

$self = $app->getself();
$logofile = $app->getlogofile();

if ($_SERVER['PHP_SELF'] == $self) {       

  echo '<img src="images/'.$logofile.'" class="img-circle" alt="User Image">';
} else {

  echo '<img src="../images/'.$logofile.'" class="img-circle" alt="User Image">';
}
        
     ?>   
        </div>
        <div class="pull-left info">
     
          <p><?= welcome(). ' '. $name.' !'?></p>

  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>
      </div>
             <form action="search.php" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="debtor" class="form-control" placeholder="Find Debtor...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

<!--Load the menu here-->
<ul class="sidebar-menu" data-widget="tree">

<?php
$group = $_SESSION ['group'];

 $q=mysqli_query($db,"SELECT * FROM usergroups WHERE id = '$group'");

        $array = mysqli_fetch_assoc($q);
        $arr = $array['menus'];

        $query=mysqli_query($db,"SELECT * FROM menus WHERE menus.id IN ($arr)");

        $query2 = mysqli_query($db,"SELECT * FROM payments JOIN paytypes ON payments.type = paytypes.id JOIN debtors ON payments.debtor_id = debtors.id WHERE payments.status = '0'");
        $approvals=mysqli_num_rows($query2);

        while($row=mysqli_fetch_array($query)){
          ?>

 <?php 

  if($row['id'] != '8'){

  $right = '<i class="fa fa-angle-left pull-right"></i>';

 } else {

  $right = '<span class="label label-primary pull-right">'.$approvals.'</span>';

 }

echo  '<li id="'.$row['id'].'" class="'.$row['active'].'">
          <a href="'.$row['file'].'">
            <i class="'.$row['icon_class'].'"></i>
            <span>'.$row['tab_name'].'</span>
            <span class="pull-right-container">'.
            $right.'
            </span>
          </a>
          <ul class="treeview-menu">';

          $menu_id = $row['id'];

$subquery=mysqli_query($db,"SELECT submenu.id, menu_id, submenu.icon_class, submenu.tab_name, submenu.link, submenu.file, menus.id AS idd FROM submenu LEFT JOIN menus ON submenu.menu_id = menus.id WHERE submenu.menu_id = $menu_id");

while($row=mysqli_fetch_array($subquery)){

//rows: id | menu_id | active_class(__leave blank/active| icon_class | tab_name | link | file | 
echo '<li onclick="mytab()" class=""><a href="'.$row['file'].'"><i class="'.$row['icon_class'].'"></i>'.$row['tab_name'].'</a></li>'?>


 <?php
        }
      ?>    
        <?php echo '</ul>'?>
        <?php echo '</li>'?>
      
      <?php
        }
      ?>    
      <!--Load the menu ends here-->
        
    </section>
    <!-- /.sidebar -->
  </aside>
