<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['filePath'])) {

    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];
    $services = $_POST['services'];
    $phaseofwork = $_POST['phaseofwork'];

    $taskId = $_POST['taskId'];
    $taskTitle = $_POST['taskTitle'];
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];

    $notes = $_POST['notes'];
    $fileName = $_POST['fileName'];
    $filePath = addslashes($_POST['filePath']);
    $userfirstName = $_SESSION['UserLogin'];
    $userlastName = $_SESSION['Userlname'];
    $managerId = $_POST['managerId'];
    $filePathStatus = 'new';
    
    $sql = "INSERT INTO `upload_file_path`(`project_id`, `project_name`, `service`, `phase_of_work`, `task_id`, `task_title`, `employee_id`, `employee_name`, `notes`, `file_name`, `file_path`, `file_path_status`, `uploaded_by`, `manager_id`) VALUES ('$projectId', '$projectName', '$services', '$phaseofwork', '$taskId', '$taskTitle', '$employeeId', '$employeeName', '$notes', '$fileName', '$filePath', '$filePathStatus', '$userfirstName $userlastName', '$managerId')";

    $con->query($sql) or die ($con->error);

}

?>