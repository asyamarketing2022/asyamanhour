<?php 

include_once("connections/connection.php");
$con = connection();

// $sql = "SELECT * FROM registered_users ORDER BY id ASC";
$sql = "SELECT * FROM registered_users WHERE access = 'manager'";
$manager = $con->query($sql) or die ($con->error);
$managerInfo = $manager->fetch_assoc();

?>