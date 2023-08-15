<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['taskId'])){

        $taskId = $_POST['taskId'];
        $total_spend_hours = $_POST['total_spend_hours'];

        $sql_update = "UPDATE `employees_tasks` SET `total_spend_hours` = '$total_spend_hours' WHERE id = '$taskId'";
        $con->query($sql_update) or die($con->error);
      
        $query_employees_update_tasks = "SELECT * FROM `employees_tasks` WHERE id = $taskId";
        $employee_update_tasks = $con->query($query_employees_update_tasks) or die ($con->error);
        $row = $employee_update_tasks->fetch_assoc();

        echo $row['total_spend_hours'];

    }

?>