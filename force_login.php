<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>
<?php include_once('url.php'); ?>

<?php 

$userId = $_SESSION['UserId'];

if(empty($userId)) {

    header("Location: $URL/index.php");

} 

?>