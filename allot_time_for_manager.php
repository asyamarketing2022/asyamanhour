<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['managerAllot_time'])) {

        $allotTime = $_POST['managerAllot_time'];
        $ramainingTime = $allotTime;
        $managerId = $_POST['managerId'];
        $projectId = $_POST['projectId'];
        $phase_of_work = $_POST['searchManager_pow'];
        $service = $_POST['searchManager_service'];
        $projectName = $_POST['projectName'];
        $managerFullname = $_POST['managerFullname'];

        $sql = "INSERT INTO `managers_allot_time`(`employee_id`, `employee_name`, `project_id`, `project_name`, `services`, `phase_of_work`, `allot_time`, `remaining_time`) VALUE ('$managerId', '$managerFullname', '$projectId', '$projectName', '$service', '$phase_of_work', '$allotTime', '$ramainingTime')";

        $con->query($sql) or die ($con->error);


    }

?>