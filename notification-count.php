<?php 

include_once("connections/connection.php");
$con = connection();

if(!isset($_SESSION)) 
    { 
        session_start(); 
} 

$userID = $_SESSION['UserId'];

//New Task Notification 
$sql = "SELECT invite_status FROM employees_tasks WHERE employee_id = $userID";
$project = $con->query($sql) or die ($con->error);

$_SESSION['new_task_notif'] = '';

if (mysqli_num_rows($project) > 0){

    while($row = mysqli_fetch_assoc($project)) {

        if($row['invite_status'] == 'new') {

            $newProject_array[] = $row['invite_status'];

            $_SESSION['new_task_notif'] = count($newProject_array);

        }
    }
} 

//New Fil Path Notification 
$sql = "SELECT file_path_status FROM upload_file_path WHERE manager_id = $userID";
$new_file_path = $con->query($sql) or die ($con->error);

$_SESSION['new_file_path_notif'] = '';

if (mysqli_num_rows($new_file_path ) > 0){

    while($file_path_row = mysqli_fetch_assoc($new_file_path)) {

        if($file_path_row['file_path_status'] == 'new') {

            $new_file_path_array[] = $file_path_row['file_path_status'];

            $_SESSION['new_file_path_notif'] = count($new_file_path_array);

        }
    }
} 

$new_task_count = (!empty((int)$_SESSION['new_task_notif']) ? (int)$_SESSION['new_task_notif'] : 0);
$new_file_path_count = (!empty((int)$_SESSION['new_file_path_notif']) ? (int)$_SESSION['new_file_path_notif'] : 0);

echo $new_task_count + $new_file_path_count;


mysqli_close($con);

?>