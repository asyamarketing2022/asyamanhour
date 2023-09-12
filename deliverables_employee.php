<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

$sql_employees = "SELECT * FROM registered_users ORDER BY id ASC";
$employees = $con->query($sql_employees) or die ($con->error);
$employeeInfo = $employees->fetch_assoc();


?>