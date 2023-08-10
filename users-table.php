<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

$sql = "SELECT * FROM registered_users ORDER BY id ASC";
$users = $con->query($sql) or die ($con->error);
$userInfo = $users->fetch_assoc();




?>