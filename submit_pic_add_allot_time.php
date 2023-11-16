<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if($_POST['additional_allot_time']){

    $projectId = $_POST['projectId'];
    $taskId = $_POST['taskId'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $additional_allot_time = $_POST['additional_allot_time'];
    $login_userId = $_SESSION['UserId'];

    //Fetch PIC task time
    $query_pic_task_allot_time = "SELECT * FROM employees_tasks WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND id = '$taskId'";
    $pic_task_allot_time = $con->query($query_pic_task_allot_time) or die ($con->error);
    $time = $pic_task_allot_time->fetch_assoc();

    $update_allot_time = $time['allot_time'] + $additional_allot_time;
    $update_remaining_time = $time['remaining_time'] + $additional_allot_time;

    //Update PIC task time
    $update_pic_task_allot_time = "UPDATE `employees_tasks` SET `allot_time` = '$update_allot_time', `remaining_time` = '$update_remaining_time' WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND id = '$taskId'";
    $con->query($update_pic_task_allot_time) or die ($con->error);

    //Decreate the manager remaining time
    $query_manager_alloted_time = "SELECT * FROM managers_allot_time WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$login_userId'";
    $manager_alloted_time = $con->query($query_manager_alloted_time) or die ($con->error);
    $manager_remaining_time = $manager_alloted_time->fetch_assoc();

    $update_manager_remaining_time = $manager_remaining_time['remaining_time'] - $additional_allot_time;

    //Update the manager remaining time
    $update_manager_remaining_time = "UPDATE `managers_allot_time` SET `remaining_time` = '$update_manager_remaining_time' WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$login_userId'";
    $con->query($update_manager_remaining_time) or die ($con->error);

    //Echo the total alloted time for PIC task
    echo $update_allot_time;

}