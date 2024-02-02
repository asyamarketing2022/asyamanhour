<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['employeeAssigned_id'])) {
    $employeeAssigned_id = explode(" ", $_POST['employeeAssigned_id']);
    array_pop($employeeAssigned_id);
    $photosIdCount = count($employeeAssigned_id);

    $managerIds = explode(" ", $_POST['managerIds']);

    for ($i = 0; $i < $photosIdCount; $i++) {

        $userID = $employeeAssigned_id[$i];
        $managerid = $managerIds[$i];

        $query_users = "SELECT * FROM registered_users WHERE ID = '$userID'";
        $assignedEmployee = $con->query($query_users) or die ($con->error);
        $assignedEmployeeInfo = $assignedEmployee->fetch_assoc();

        $query_manager = "SELECT * FROM registered_users WHERE ID = '$managerid'";
        $manager = $con->query($query_manager) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

        // <button><a href='#'>View Profile</a></button>
        echo "<div class='user_container' value='" . $assignedEmployeeInfo['ID'] . "'>
                <div class='user_photo'>
                    <img class='photoCircle' src='img/upload/" . $assignedEmployeeInfo['user_image'] . "' alt='' width='200'>
                
                </div>
                <div class='user_info'>
                    <div class='user_assignedBy' value='" . $managerInfo['ID']  . "'>
                        <label>Assigned By:</label>
                        <span>" . $managerInfo['first_name'] . " " . $managerInfo['last_name'] . "</span>
                    </div>

                    <div class='user_fullname'>
                        <label>Name:</label>
                        <span>" . $assignedEmployeeInfo['first_name'] . " " . $assignedEmployeeInfo['last_name'] . "</span>
                    </div>
        
                    <div class='user_position'>
                        <label>Position:</label>
                        <span>" . $assignedEmployeeInfo['position'] . "</span>
                    </div>

                    <div class='user_department'>
                        <label>Department:</label>
                        <span>" . $assignedEmployeeInfo['department'] . "</span>
                    </div>

                    <div class='user_tasks border-0'>
                        <button class='border-0 viewTasks'>View Tasks</button>
                    </div>
                </div>
            </div>";

            // <button class='border-0'><a href='#' class='viewTasks m-3'>View Tasks</a></button>
    }
}

?>