<?php 

if(!isset($_SESSION)){
    session_start();
}

include_once('connections/connection.php');
$con = connection();

$loginID = $_SESSION['UserId'];

// $result = mysqli_query($con, 'SELECT project_in_charge_id FROM assign_project');

// while ($usersID = mysqli_fetch_assoc($result)){

//     $usersID_array = explode(' ', $usersID['project_in_charge_id']);

//     // $userID = implode(' ', $usersID_array);

//     foreach ($usersID_array as $userID) {

//         if($userID == $loginID) {

//             echo $userID;

//         }

//     }

// }

$sql = "SELECT * FROM assign_project WHERE project_in_charge_id LIKE '%$loginID%'";
$project = $con->query($sql) or die ($con->error);
$picProject = $project->fetch_assoc();


?>