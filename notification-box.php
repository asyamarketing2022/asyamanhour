<?php 

include_once("connections/connection.php");
$con = connection();

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$userID = $_SESSION['UserId'];

// $sql = "SELECT * FROM project_history WHERE employee_id = $userID";
// $notif = $con->query($sql) or die ($con->error);
// $notif_info = $notif->fetch_assoc();

$sql = "SELECT * FROM project_history WHERE employee_id = $userID";
$notif = $con->query($sql) or die ($con->error);
$notif_info = $notif->fetch_assoc();


?>