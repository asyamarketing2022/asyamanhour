<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['taskId'])){

        $taskId = $_POST['taskId'];
        $total_spend_hours = $_POST['total_spend_hours'];

        $sql_update = "UPDATE `employees_tasks` SET `total_spend_hours` = '$total_spend_hours' WHERE id = '$taskId'";
        $con->query($sql_update) or die($con->error);

        // $query_spend_total_hours = "SELECT * FROM `employees_tasks` WHERE id = $taskId";
        // $spend_total_hours = $con->query($query_spend_total_hours) or die ($con->error);
        // $total_hours = $spend_total_hours->fetch_assoc();

        // echo $total_spend_hours;
      
    }

?>