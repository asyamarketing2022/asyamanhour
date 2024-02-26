<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

// $userId = $_SESSION['UserId'];
$userId = empty($_SESSION['UserId']) ? "" : $_SESSION['UserId'];

if(!empty($userId)) {

    header("Location: $URL/homepage.php");

} 

?>