<?php

 class Menu{

function getmenu($link) {

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		
		 $sql = "SELECT * FROM menus WHERE link = '$link'";
 	         $result = mysqli_query($db,$sql);
 			
		 while ($row = mysqli_fetch_array($result)) {

                 return  $row ['link'];
     }
   }	
}
?>