<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['uploadfilepath'])){

   $projectId = $_POST['projectId'];
   $projectName = $_POST['projectName'];
   $projectService = $_POST['projectService'];
   $phaseofwork = $_POST['phaseofwork'];
   $notes = $_POST['notes'];
   $fileName = $_POST['fileName'];
   $filePath = addslashes($_POST['filePath']);
   $userfirstName = $_POST['userfirstName'];
   $userlastName = $_POST['userlastName'];
   
    $sql = "INSERT INTO `upload_file_path`(`project_id`, `project_name`, `service`, `phase_of_work`, `notes`, `file_name`, `file_path`, `uploaded_by`) VALUES ('$projectId', '$projectName', '$projectService', '$phaseofwork', '$notes', '$fileName', '$filePath', '$userfirstName $userlastName' )";

    $con->query($sql) or die ($con->error);

}

?>