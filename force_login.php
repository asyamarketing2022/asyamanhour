<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$userId = $_SESSION['UserId'];

if(empty($userId)) {

    header("Location: http://192.168.50.248/asyamanhour/index.php");

} 

?>