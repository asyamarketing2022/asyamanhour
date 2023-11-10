<?php 
// if(!isset($_SESSION)){
//     session_start();
// }

// include_once('login.php'); 
include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['taskId'])) {

    $taskId = $_POST['taskId'];

    $query_tasks_remaining_time = "SELECT * FROM employees_tasks WHERE id = '$taskId'";
    $tasks_remaining_time = $con->query($query_tasks_remaining_time) or die ($con->error);
    $remaining_time = $tasks_remaining_time->fetch_assoc();

    echo $remaining_time['remaining_time'];
   
}

?>