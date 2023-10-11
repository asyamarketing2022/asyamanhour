<?php 

include_once("connections/connection.php");
$con = connection();


    if(isset($_POST['add_phase_of_work'])) {

        $projectId = $_POST['projectId'];
        $phase_of_work = $_POST['add_phase_of_work'];

        // $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectId'";
        // $project = $con->query($query_projects) or die ($con->error);
        // $row = $project->fetch_assoc();

        // echo $row['project_name'];

        $sql_update_projects = "UPDATE `pms_projects` SET `$phase_of_work` = '1' WHERE id = '$projectId'";

        $con->query($sql_update_projects) or die ($con->error);


    }

?>