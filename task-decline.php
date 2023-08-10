<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['taskId'])){

  $taskId = $_POST['taskId'];
  $declineText = $_POST['declineText'];
  $declineNotes = $_POST['declineNotes'];

  $sql = "UPDATE `employees_tasks` SET `invite_status` = '$declineText', `decline_notes` = '$declineNotes' WHERE id = '$taskId'";

  $con->query($sql) or die ($con->error);

  echo $acceptText;

}


?>