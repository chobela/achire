<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/

// Database Connection
require("config.php");

// get Users
$query = "SELECT name, owing FROM debtors";
if (!$result = mysqli_query($db, $query)) {
    exit(mysqli_error($db));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

//header('Content-Type: text/csv; charset=utf-8');
//header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('reports/Users.csv', 'w');
fputcsv($output, array('name', 'Owing'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
fclose($output);
?>