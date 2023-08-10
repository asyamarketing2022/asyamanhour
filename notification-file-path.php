<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM upload_file_path WHERE manager_id = $userID ORDER BY id DESC";
$filePath = $con->query($sql) or die ($con->error);
$filePath_notif = $filePath->fetch_assoc();



?>