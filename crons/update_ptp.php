<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u839333499_achireuser');
define('DB_PASSWORD', '3#Uo^UGt');
define('DB_DATABASE', 'u839333499_achiredb');


$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERRORrrr"}';
}

/*$sql = "SELECT * FROM ptp WHERE status = '4' AND date = CURDATE()";
$rows = mysqli_query($db,$sql);


   while($row=mysqli_fetch_array($rows)){

   //	mysqli_query($db,"UPDATE ptp SET status = '4' WHERE date = CURDATE()");
   echo $row['amount'];
   $myfile = fopen("newcronfile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $row['amount']);
fclose($myfile);


   }
*/
   echo 'hello world';


?>