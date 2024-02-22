<?php include_once('connections/DBconnection.php'); ?>


<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['taskId'])){

        $taskId = $_POST['taskId'];
        $total_spend_hours = $_POST['total_spend_hours'];

        $sql_update = "UPDATE `employees_tasks` SET `total_spend_hours` = '$total_spend_hours' WHERE id = '$taskId'";
        $con->query($sql_update) or die($con->error);


        //Call a function to add all spend hours and update the employees_logs_hours table
        include_once('employees_date_logs_auto_update.php');

    }

?>