<?php include_once("connections/DBconnection.php"); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['updateStatus'])){

    $updateStatus = $_POST['updateStatus'];
    $taskId = $_POST['taskId'];

    $sql = "UPDATE `employees_tasks` SET `status` = '$updateStatus' WHERE id = '$taskId'";

    $con->query($sql) or die ($con->error);

    echo "<span>$updateStatus</span>";

} elseif(isset($_POST['inputText'])) {

    $inputText =  ucfirst(strtolower($_POST['inputText']));
    $taskId = $_POST['taskId'];

    $sql = "UPDATE `employees_tasks` SET `status` = '$inputText' WHERE id = '$taskId'";

    $con->query($sql) or die ($con->error);
  
    echo "<span>$inputText</span>";

}

?>