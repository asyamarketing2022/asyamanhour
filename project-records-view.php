<?php $page = 'project-records'; include 'header.php'; ?>
<?php include_once("sidebar.php"); ?>

<?php 

$projectID = $_GET['ID'];

$query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
$project = $con->query($query_projects) or die ($con->error);
$row = $project->fetch_assoc();

?>


<h1>Hotdog</h1>




<?php include 'footer.php'; ?>