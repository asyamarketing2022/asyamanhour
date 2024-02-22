<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

//Get Project ID 
$projectID = $_GET['ID'];

$sql = "SELECT * FROM pms_projects WHERE project_revise_id = '$projectID'";
$sql_pms_project_revise = $con->query($sql) or die($con->error);
$pms_project_revise = $sql_pms_project_revise->fetch_assoc();

?> 