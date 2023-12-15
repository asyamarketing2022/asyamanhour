<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM employees_tasks WHERE employee_id = $userID ORDER BY id DESC";
$tasks = $con->query($sql) or die ($con->error);
$newtask_notif = $tasks->fetch_assoc();



//fetch who sent the task


?>