<?php 

include_once("connections/connection.php");
$con = connection();

if(!isset($_SESSION))
{
    session_start();
}


if(isset($_POST['submitAssign'])) {

    $employeesID_array = $_POST['userID'];
    $employees_array = $_POST['user'];
    // $employeePosition = $_SESSION['Access'];
    $projectId = $_POST['projectId'];
    $projectCode = $_POST['code'];
    $projectName = $_POST['projectName'];
    $notifStatus = 'new';
    $status = $_POST['status'];

    foreach(array_combine($employeesID_array, $employees_array) as $employeeId => $employee) {

        $sql = "INSERT INTO `project_history` (`employee_id`, `employee`, `project_id`, `project_code`, `project_name`, `notif_status`, `status`) VALUE ('$employeeId', '$employee', '$projectId', '$projectCode', '$projectName', '$notifStatus', '$status')";
        $con->query($sql) or die ($con->error);

    }

}



if(isset($_POST['submitPIC'])) {
    $employeesID_array = $_POST['userID'];
    $employees_array = $_POST['user'];
    $projectId = $_POST['projectId'];
    $projectCode = $_POST['code'];
    $projectName = $_POST['projectName'];
    $notifStatus = 'new';
    $status = $_POST['status'];

    foreach(array_combine($employeesID_array, $employees_array) as $employeeId => $employee) {

        $sql = "INSERT INTO `project_history` (`employee_id`, `employee`, `project_id`, `project_code`, `project_name`, `notif_status`, `status`) VALUE ('$employeeId', '$employee', '$projectId', '$projectCode', '$projectName', '$notifStatus', '$status')";
        $con->query($sql) or die ($con->error);

    }
}

?>