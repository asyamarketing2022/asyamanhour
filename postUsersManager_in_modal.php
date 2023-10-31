<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['managerPhotoId'])) {
    $managerPhotoId = explode(" ", $_POST['managerPhotoId']);
    array_pop($managerPhotoId);
    $photosIdCount = count($managerPhotoId);

    $projectId = $_POST['projectId'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];

    for ($i = 0; $i < $photosIdCount; $i++) {

        $userID = $managerPhotoId[$i];

        $query_users = "SELECT * FROM registered_users WHERE ID = '$userID'";
        $manager = $con->query($query_users) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

        //Query Managers Alot Time
        $query_alot_time = "SELECT * FROM managers_alot_time WHERE employee_id = '$userID' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
        $managers_alot_time = $con->query($query_alot_time) or die ($con->error);
        $alot_time = $managers_alot_time->fetch_assoc();

        if($managers_alot_time->num_rows != 0){

            echo "<div class='user_container' value='" . $managerInfo['ID'] . "'>
                    <div class='user_photo'>
                        <img class='photoCircle' src='img/upload/" . $managerInfo['user_image'] . "' alt='' width='200'>
                        <button><a href='#'>View Profile</a></button>
                    </div>
                    <div class='user_info'>
                        <div class='user_fullname'>
                            <label>Remaining Time:</label>
                            <span>" . $alot_time['alot_time'] ."</span>
                        </div>

                        <div class='user_fullname'>
                            <label>Name:</label>
                            <span>" . $managerInfo['first_name'] . " " . $managerInfo['last_name'] . "</span>
                        </div>
            
                        <div class='user_position'>
                            <label>Position:</label>
                            <span>" . $managerInfo['position'] . "</span>
                        </div>

                        <div class='user_department'>
                            <label>Department:</label>
                            <span>" . $managerInfo['department'] . "</span>
                        </div>
                        <div class='user_tasks border-0'>
                            <button class='border-0'><a href='#' class='viewTasks m-3'>View Tasks</a></button>
                        </div>
                    </div>
                </div>";

        } else {

            echo "<div class='user_container' value='" . $managerInfo['ID'] . "'>
                    <div class='user_photo'>
                        <img class='photoCircle' src='img/upload/" . $managerInfo['user_image'] . "' alt='' width='200'>
                        <button><a href='#'>View Profile</a></button>
                    </div>
                    <div class='user_info'>
                        <div class='user_fullname'>
                            <label>Remaining Time:</label>
                            <span>0</span>
                        </div>

                        <div class='user_fullname'>
                            <label>Name:</label>
                            <span>" . $managerInfo['first_name'] . " " . $managerInfo['last_name'] . "</span>
                        </div>
            
                        <div class='user_position'>
                            <label>Position:</label>
                            <span>" . $managerInfo['position'] . "</span>
                        </div>

                        <div class='user_department'>
                            <label>Department:</label>
                            <span>" . $managerInfo['department'] . "</span>
                        </div>
                        <div class='user_tasks border-0'>
                            <button class='border-0'><a href='#' class='viewTasks m-3'>View Tasks</a></button>
                        </div>
                    </div>
                </div>";

        }

    }
}

?>