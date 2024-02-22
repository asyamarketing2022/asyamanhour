<?php 

include_once("connections/connection.php");
$con = connection();

    if(isset($_POST['projectId'])){

        $projectId = $_POST['projectId'];

        $query_projects = "SELECT * FROM pms_projects WHERE id = $projectId";
        $projects = $con->query($query_projects) or die($con->error);
        $project = $projects->fetch_assoc();

        $projectName = $project['project_name'];
        $projectLocation = $project['location'];
        $projectLot_areas = $project['lot_areas'];
        $projectTypology = $project['typology'];
        $projectCompany_name = $project['company_name'];
        $projectClient_name = $project['client_name'];

        $sql = "INSERT INTO `pms_projects`(`project_name`, `location`, `lot_areas`, `typology`, `company_name`, `client_name`, `status`) VALUES ('$projectName(revise)', '$projectLocation', '$projectLot_areas', '$projectTypology', '$projectCompany_name', '$projectClient_name', 'revise')";

        $con->query($sql) or die ($con->error);

        // $sql->addNewNames = $db->prepare($sql);
        // addNewNames->execute(array(':userid' => $userid));

        echo mysqli_insert_id($con);

    }


?>