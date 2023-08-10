<?php 

include_once("connections/DBconnection.php");
include_once("login.php");

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM registered_users WHERE ID = '$userID'";
$userProfile = $con->query($sql) or die ($con->error);
$user_profile = $userProfile->fetch_assoc()

?>