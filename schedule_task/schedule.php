<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "inquiry";

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);

$conn->set_charset("utf8");
mysqli_query($conn,'SET CHARACTER SET utf8'); 
mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");

$sql="update inquiry set status = 789 where status =123108";
mysqli_multi_query($conn, $sql);


?>	