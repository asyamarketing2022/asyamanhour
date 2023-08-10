<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['date'])){

       $date = $_POST['date'];
       $name = $_POST['name'];
       $projectId = $_POST['projectId'];

       $sql = "UPDATE `pms_projects` SET `$name` = '$date' WHERE id = '$projectId '";

       $con->query($sql) or die ($con->error);

    }

?>