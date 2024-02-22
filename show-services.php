<?php 

include_once("connections/connection.php");
$con = connection();

    if($_POST['projectId']) {

        $projectId = $_POST['projectId'];

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectId'";
        $project = $con->query($query_projects) or die ($con->error);
        $row = $project->fetch_assoc();

        $output = '';

        if($row['service_architecture'] == 0) {

            $output .= "<span class='service_architecture'>Architecture</span>";

        }

        if($row['service_engineering'] == 0) {

            $output .= "<span class='service_engineering'>Engineering</span>";
            
        }

        if($row['service_interior'] == 0) {

            $output .= "<span class='service_interior'>Interior</span>";

        }

        if($row['service_masterplanning'] == 0){

            $output .= "<span class='service_masterplanning'>Master Planning</span>";

        }

        echo $output;

    }

?>