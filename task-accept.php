<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['taskId'])){

  $taskId = $_POST['taskId'];
  $acceptText = $_POST['acceptText'];

  $sql = "UPDATE `employees_tasks` SET `invite_status` = '$acceptText' WHERE id = '$taskId'";

  $con->query($sql) or die ($con->error);

  echo $acceptText;

}


?>