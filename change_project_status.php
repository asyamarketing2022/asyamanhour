<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['projectId'])){

        $projectId = $_POST['projectId'];
        $updateStatus = $_POST['updateStatus'];

        $sql = "UPDATE `pms_projects` SET `project_status` = '$updateStatus' WHERE id = '$projectId'";

        $con->query($sql) or die ($con->error);

        echo $updateStatus;

    }

?>