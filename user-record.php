<?php 

if(!isset($_SESSION)){
    session_start();
}

function userRecord($action = null, &$source = null) {

    include_once("connections/connection.php");
    $con = connection();

    // User Record Action Login
    $firstName = $_SESSION['UserLogin'];
    $lastName = $_SESSION['Userlname'];
    $userId = $_SESSION['UserId'];
    $userPostion = $_SESSION['Position'];
    $userDepartment = $_SESSION['Department'];
    
    $actionStatus = 'success';
    
    $sql_userRecord = "INSERT INTO `users_record`(`user_name`, `user_id`, `user_position`, `department`, `action`, `source`, `action_status`) VALUE ('$firstName $lastName', '$userId', '$userPostion', '$userDepartment', '$action', '$source', '$actionStatus')";
     
    $con->query($sql_userRecord) or die ($con->error);
}



?>