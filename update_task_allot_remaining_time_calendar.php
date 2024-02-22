<?php  
include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['selected_project_id'])){

        $projectId = $_POST['selected_project_id'];
        $taskId = $_POST['selected_task_id'];
        $task_spend_hours = $_POST['add_logs_task_spend_hours'];

        // Query employee task
        $query_tasks_remaining_time = "SELECT * FROM employees_tasks WHERE id = '$taskId' AND project_id = '$projectId'";
        $tasks_remaining_time = $con->query($query_tasks_remaining_time) or die ($con->error);
        $time = $tasks_remaining_time->fetch_assoc();

        $remainingTime = $time['remaining_time'] - $task_spend_hours;
   
        // Update the employee task remaining time
        $update_task_remaining_time = "UPDATE `employees_tasks` SET `remaining_time` = '$remainingTime' WHERE id = '$taskId' AND project_id = '$projectId'";
        $con->query($update_task_remaining_time) or die ($con->error);

    }


?>
