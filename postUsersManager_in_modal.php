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

    for ($i = 0; $i < $photosIdCount; $i++) {

        $userID = $managerPhotoId[$i];

        $query_users = "SELECT * FROM registered_users WHERE ID = '$userID'";
        $manager = $con->query($query_users) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

        echo "<div class='user_container' value='" . $managerInfo['ID'] . "'>
                <div class='user_photo'>
                    <img class='photoCircle' src='img/upload/" . $managerInfo['user_image'] . "' alt='' width='200'>
                    <button><a href='#'>View Profile</a></button>
                </div>
                <div class='user_info'>
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

?>