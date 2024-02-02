<?php  
include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['selectedTask_val'])) {

    $selectedTask_val = $_POST['selectedTask_val'];

    $query_tasks_remaining_time = "SELECT * FROM employees_tasks WHERE id = '$selectedTask_val'";
    $tasks_remaining_time = $con->query($query_tasks_remaining_time) or die ($con->error);
    $remaining_time = $tasks_remaining_time->fetch_assoc();

    echo $remaining_time['remaining_time'];
   
}

?>