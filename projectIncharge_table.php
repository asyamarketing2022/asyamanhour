<?php 

include_once("connections/connection.php");
$con = connection();

// $sql = "SELECT * FROM registered_users ORDER BY id ASC";
$sql = "SELECT * FROM registered_users WHERE access = 'employee'";
$employee = $con->query($sql) or die ($con->error);
$employeeInfo = $employee->fetch_assoc();

?>