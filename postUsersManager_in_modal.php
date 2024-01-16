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
    $access = $_SESSION['Access'];

    for ($i = 0; $i < $photosIdCount; $i++) {

        $userID = $managerPhotoId[$i];

        $query_users = "SELECT * FROM registered_users WHERE ID = '$userID'";
        $manager = $con->query($query_users) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

        //Query Managers Alot Time
        $query_allot_time = "SELECT * FROM managers_allot_time WHERE employee_id = '$userID' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
        $managers_allot_time = $con->query($query_allot_time) or die ($con->error);
        $allot_time = $managers_allot_time->fetch_assoc();

        if($managers_allot_time->num_rows != 0){

           if($access == 'admin') {

            // <button><a href='#'>View Profile</a></button>
            echo "<div class='user_container' value='" . $managerInfo['ID'] . "'>
                    <div class='user_photo'>
                        <img class='photoCircle' src='img/upload/" . $managerInfo['user_image'] . "' alt='' width='200'>
                     
                    </div>
                    <div class='user_info'>
                        <div class='user_allot_time'>
                            <label>Allot Time:</label>
                            <span>" . $allot_time['allot_time'] ."</span>
                            <div class='additional_time'>
                                <img class='manager_additional_time_btn' src='img/add-icon.png' width='25'>
                                <div class='add_time_input d-none'>
                                    <input type='number' class='additional_time_value' value='0' min='1'>
                                    <button type='button' class='btn btn-primary submit_additional_time'>Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class='user_remaining_time'>
                            <label>Remaining Time:</label>
                            <span>" . $allot_time['remaining_time'] . "</span>
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
            // <button><a href='#'>View Profile</a></button>
                echo "<div class='user_container' value='" . $managerInfo['ID'] . "'>
                        <div class='user_photo'>
                            <img class='photoCircle' src='img/upload/" . $managerInfo['user_image'] . "' alt='' width='200'>
                        
                        </div>
                    <div class='user_info'>
                        <div class='user_allot_time'>
                            <label>Allot Time:</label>
                            <span>" . $allot_time['allot_time'] ."</span>
                            <div class='additional_time'>
                             
                                <div class='add_time_input d-none'>
                                    <input type='number' class='additional_time_value' value='0' min='1'>
                                    <button type='button' class='btn btn-primary submit_additional_time'>Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class='user_remaining_time'>
                            <label>Remaining Time:</label>
                            <span>" . $allot_time['remaining_time'] . "</span>
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