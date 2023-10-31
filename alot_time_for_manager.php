<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['managerAlot_time'])) {

        $alotTime = $_POST['managerAlot_time'];
        $managerId = $_POST['managerId'];
        $projectId = $_POST['projectId'];
        $phase_of_work = $_POST['searchManager_pow'];
        $service = $_POST['searchManager_service'];
        $projectName = $_POST['projectName'];
        $managerFullname = $_POST['managerFullname'];

        $sql = "INSERT INTO `managers_alot_time`(`employee_id`, `employee_name`, `project_id`, `project_name`, `services`, `phase_of_work`, `alot_time`) VALUE ('$managerId', '$managerFullname', '$projectId', '$projectName', '$service', '$phase_of_work', '$alotTime')";

        $con->query($sql) or die ($con->error);


    }

?>