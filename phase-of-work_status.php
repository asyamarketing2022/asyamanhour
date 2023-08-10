<?php include_once("connections/DBconnection.php"); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['updateStatus'])){

    $projectId = $_POST['projectId'];
    $status_db_Row = $_POST['status_db_Row'];
    $updateStatus = $_POST['updateStatus'];
 
    $sql = "UPDATE `pms_projects` SET `$status_db_Row` = '$updateStatus' WHERE id = '$projectId'";

    $con->query($sql) or die ($con->error);

    echo "<span>$updateStatus</span>";


} elseif(isset($_POST['inputText'])) {

    $projectId = $_POST['projectId'];
    $status_db_Row = $_POST['status_db_Row'];
    $inputText =  ucfirst(strtolower($_POST['inputText']));

    $sql = "UPDATE `pms_projects` SET `$status_db_Row` = '$inputText' WHERE id = '$projectId'";

    $con->query($sql) or die ($con->error);

    echo "<span>$inputText</span>";

}

?>
