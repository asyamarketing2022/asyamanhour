<?php 

include_once("connections/DBconnection.php");
include_once('login.php');

$db = new DBconnection();
$con = $db->connection();


    if(isset($_POST['managerId'])){

        //User Login Id
        $login_userId = $_SESSION['UserId'];

        if($_POST['managerId'] == $login_userId){

            echo "<img class='addProjectInChargeBtn' data-toggle='modal' data-target='#addProjectInCharge' src='img/add-icon.png' alt='' width='50'>";

        }

    }

 
?>