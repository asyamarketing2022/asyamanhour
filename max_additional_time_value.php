<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['managerId'])){

    // $login_userId = $_SESSION['UserId'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $managerId = $_POST['managerId'];
    $projectId = $_POST['projectId'];

    $query_manager_remaining_time = "SELECT * FROM managers_allot_time WHERE employee_id = '$managerId' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
    $manager_remaining_time = $con->query($query_manager_remaining_time) or die ($con->error);
    $remaining_time = $manager_remaining_time->fetch_assoc();

    echo $remaining_time['remaining_time'];

}

?>