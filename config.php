<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u839333499_achireuser');
define('DB_PASSWORD', '3#Uo^UGt');
define('DB_DATABASE', 'u839333499_achiredb');


$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db))
{
   echo '{"query_result":"ERRORrrr"}';
}

?>

