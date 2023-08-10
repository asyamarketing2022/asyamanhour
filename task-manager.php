<?php include_once('connections/DBconnection.php'); ?>
<?php include_once("login.php"); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])){

    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];
    $service = $_POST['searchManager_service'];
    $phase_of_work = $_POST['searchManager_pow'];
    $managerId = $_POST['managerId'];
    $managerFullname = $_POST['managerFullname'];

    $userfirstName = $_SESSION['UserLogin'];
    $userlastName = $_SESSION['Userlname'];
    
    $invite_status = 'new';

    $sql = "INSERT INTO `managers_tasks`(project_id`, `project_name`, `services`, `phase_of_work`, `manager_id`, `manager_name`, `invite_status`, `sent_by`) VALUE ('$projectId', '$projectName', '$service', '$phase_of_work', '$managerId', '$managerFullname', '$invite_status', '$userfirstName $userlastName')";

    $con->query($sql) or die ($con->error);

}


?>