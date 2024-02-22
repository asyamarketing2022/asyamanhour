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

  // echo $acceptText;

  //Fetch employee task info
  $query_employee_task_info = "SELECT * FROM employees_tasks WHERE id = '$taskId'";
  $employee_task_info = $con->query($query_employee_task_info) or die ($con->error);
  $task_info = $employee_task_info->fetch_assoc();

  $projectId = $task_info['project_id'];
  $services = $task_info['services'];
  $phase_of_work = $task_info['phase_of_work'];
  $managerId = $task_info['manager_id'];
  $allotTime = $task_info['allot_time'];

  //Fetch manager allot time
  $query_manager_remaining_time = "SELECT * FROM managers_allot_time WHERE employee_id = '$managerId' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
  $managers_remaining_time = $con->query($query_manager_remaining_time) or die ($con->error);
  $remaining_time = $managers_remaining_time->fetch_assoc();

  $remainingTime = $remaining_time['remaining_time'];

  // echo $remainingTime;

  //Add the manager remaining allot time and the declined PIC task allot time
  $total_remaining_time = $allotTime + $remainingTime;

  //Update the manager remaining time
  $update_remaining_time = "UPDATE `managers_allot_time` SET `remaining_time` = '$total_remaining_time' WHERE employee_id = '$managerId' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work'";

  $con->query($update_remaining_time) or die ($con->error);


}


?>