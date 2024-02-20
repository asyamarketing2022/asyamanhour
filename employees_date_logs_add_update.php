<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

    $db = new DBconnection();
    $con = $db->connection();

    if(isset($_POST['taskId'])) {

        $taskId = $_POST['taskId'];
        $spendhours = $_POST['spendhours'];

        $query_employee_tasks = "SELECT * FROM employees_tasks WHERE id = $taskId";
        $employee_task = $con->query( $query_employee_tasks) or die ($con->error);
        $time = $employee_task->fetch_assoc();

        $add_remaining_time = $spendhours + $time['remaining_time'];

        // Update the employee task remaining time
        $update_task_remaining_time = "UPDATE `employees_tasks` SET `remaining_time` = '$add_remaining_time' WHERE id = '$taskId'";
        $con->query($update_task_remaining_time) or die ($con->error);
       
    }


?>