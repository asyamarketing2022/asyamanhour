<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])){

    $taskId = $_POST['taskId'];
    $projectId = $_POST['projectId'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $total_spend_hours = $_POST['total_spend_hours'];

    //Fetch employees tasks
    $query_employees_task = "SELECT * FROM employees_tasks WHERE id = '$taskId' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
    $employees_task = $con->query($query_employees_task) or die ($con->error);
    $employee_task = $employees_task->fetch_assoc();

    $allot_time = $employee_task['allot_time'];

    $update_task_remaining_time = $allot_time - $total_spend_hours;

    //Update employees tasks remaining time
    $update_employee_remaining_time = "UPDATE `employees_tasks` SET `remaining_time` = '$update_task_remaining_time' WHERE id = '$taskId' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
 
    $con->query($update_employee_remaining_time) or die ($con->error);

    echo $update_task_remaining_time;

}

?>

