
<ul class="sidebar-menu" data-widget="tree">

<?php
$query=mysqli_query($db,"SELECT * FROM menus");

//check whether tab is active of not

//testlink
$link = '/recruiter/index.php';
if ($link == $menu['link']) {

$active = 'active treeview';

} else {

$active = 'nav-item has-treeview';
}
				while($row=mysqli_fetch_array($query)){
					?>

 <?php echo '<li class="'.$active.'"> <a href="'.$row['file'].'" class="'.$row['navlink'].'"> <i class="'.$row['icon'].'"></i><span>'.$row['name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a></li>'?>
			<?php
				}
			?>				

