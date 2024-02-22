<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(!empty($_POST['additional_time'])){

    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $managerId = $_POST['managerId'];
    $projectId = $_POST['projectId'];
    $additional_time = $_POST['additional_time'];
    
    //Fetch managers allot and remaining time
    $query_managers_allot_time = "SELECT * FROM managers_allot_time WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$managerId'";
    $managers_allot_time = $con->query($query_managers_allot_time) or die ($con->error);
    $manager_time = $managers_allot_time->fetch_assoc();

    $current_remainingTime = $manager_time['remaining_time'];
    $current_allotTime = $manager_time['allot_time'];

    //Combine the current remaining time and additional time
    //Combine the current alloted time and additional time
    $update_remainingTime = $current_remainingTime + $additional_time;
    $update_allotTime = $current_allotTime + $additional_time;

    //Update managers time
    $update_manager_time = "UPDATE `managers_allot_time` SET `allot_time` = '$update_allotTime', `remaining_time` = '$update_remainingTime' WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$managerId'";
    $con->query($update_manager_time) or die ($con->error);

    echo $update_allotTime;

}

?>