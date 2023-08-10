<?php include("login.php"); ?>

<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];
    
$sql = "SELECT * FROM employees_tasks WHERE employee_id = '$userID'";
$newTasks = $con->query($sql) or die ($con->error);
$newTasks_info = $newTasks->fetch_assoc();

?>