<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $projectId = $_POST['projectId'];

    $query_project = "SELECT * FROM pms_projects WHERE ID = '$projectId'";
    $project = $con->query($query_project) or die ($con->error);
    $projectInfo = $project->fetch_assoc();

    echo "<div class='profile-info tab-position_right'>
            <div class='profile-info__content'>
                <span>Project Name:</span>
                <p>" . $projectInfo['project_name'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Location:</span>
                <p>" . $projectInfo['location'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Lot Areas:</span>
                <p>" . $projectInfo['lot_areas'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Typology:</span>
                <p>" . $projectInfo['typology'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Company Name:</span>
                <p>" . $projectInfo['company_name'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Client Name:</span>
                <p>" . $projectInfo['client_name'] . "</p>
            </div>
            <div class='profile-info__content'>
                <span>Budget Hours:</span>
                <p>" . $projectInfo['allotted_hours'] . "</p>
            </div>
        </div>";

}

?>