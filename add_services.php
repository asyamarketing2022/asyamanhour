<?php 

include_once("connections/connection.php");
$con = connection();

    if(isset($_POST['add_services'])){

        $add_services = $_POST['add_services'];
        $projectId = $_POST['projectId'];
        
        $sql_update_projects = "UPDATE `pms_projects` SET `$add_services` = '1' WHERE id = '$projectId'";

        $con->query($sql_update_projects) or die ($con->error);

    }

?>