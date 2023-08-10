<?php 

include_once('connections/connection.php');
$con = connection();

if(!isset($_SESSION)) 
    { 
        session_start(); 
} 


 if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];
    $_SESSION['projectID'] = $projectID;

    $projectSQL = "SELECT * FROM assign_project WHERE id = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $myProject = $project->fetch_assoc();

    $_SESSION['assignProject_id'] = $myProject['id'];

    echo "<div class='content-info__wrapper'>
                <div class='content__info'> 
                    <span>Project ID</span>
                    <input class='input' type='text' name='projectId' id='projectId' value=" . $myProject['id'] . " required>
                </div>
                <div class='content__info'> 
                    <span>Code</span>
                    <input class='input' type='text' name='code' id='code' value=" . $myProject['project_code'] . " >
                </div>
                <div class='content__info'>
                    <span>Project Name</span>
                    <input class='input' type='text' name='projectName' id='projectName' value =" . $myProject['project_name'] . " >
                </div>
                <div class='content__info'>
                    <span>Quality Check</span>
                    <input class='input' type='text' name='qualityCheck' id='qualityCheck' aria-label='Default' value=" . $myProject['quality_check'] . " >
                </div>
                <div class='content__info'>
                    <span>File Type</span>
                    <input class='input' type='text' name='file_type' id='file_type' aria-label='Default' value=" . $myProject['file_type'] . " >
                </div>
                <div class='content__info'>
                    <span>Project Tree Style</span>
                    <input class='input' type='text' name='projectTreeStyle' id='projectTreeStyle' aria-label='Default' value= " . $myProject['project_tree_style'] . " >
                </div>
                <div class='content__info'>
                    <span>Ignore Files</span>
                    <input class='input' type='text' name='ignoreFiles' id='mobile_number formControlDefault' value=" . $myProject['ignores_files'] . " >
                </div>
                <div class='content__info'>
                    <span>String Errors Contact</span>
                    <input class='input' type='text' name='stringErrorsContact' id='stringErrorsContact formControlDefault' value=" . $myProject['string_error_contact'] . " >
                </div>
                <div class='content__info'>
                    <span>Screenshot Search Prefix</span>
                    <input class='input' type='text' name='screenSearch' id='address formControlDefault' value=" . $myProject['screenshot_search_prefix'] .  " >
                </div>
                <div class='content__info d-none'>
                    <span>Status</span>
                    <input type='text' name='status' id='address formControlDefault' value='waiting' required>
                </div>
            </div>"; }

 if(isset($_POST['submitPIC'])) {

    $assignProject_id = $_SESSION['assignProject_id'];

    $users_array = $_POST['user'];
    $usersID_array = $_POST['userID'];
    $users = implode(" ", $users_array);
    $usersID = implode(" ", $usersID_array);

    $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users', `project_in_charge_id` = '$usersID' WHERE id = '$assignProject_id'";

    $con->query($sql) or die ($con->error);

    
    }
?>