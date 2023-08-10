<?php 

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM pms_projects ORDER BY id ASC";
$project = $con->query($sql) or die ($con->error);
$projectInfo = $project->fetch_assoc();


?>