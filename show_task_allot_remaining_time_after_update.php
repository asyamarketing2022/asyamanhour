<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(!empty($_POST['spendhours'])) {

        $taskId = $_POST['taskId'];
        $spendhours = $_POST['spendhours'];

        //Fetch employees tasks
        $query_employees_tasks = "SELECT * FROM employees_tasks WHERE id = '$taskId'";
        $employees_tasks = $con->query($query_employees_tasks) or die ($con->error);
        $employee_task = $employees_tasks->fetch_assoc();

        $update_remaining_time = $employee_task['remaining_time'] + $spendhours;

        //Update the employee task remaining time
        $update_employee_task_remaining_time = "UPDATE `employees_tasks` SET `remaining_time` = $update_remaining_time WHERE id = '$taskId'"; 

        $con->query($update_employee_task_remaining_time) or die ($con->error);

        echo $update_remaining_time;

    } else {

        //If the spend hours is empty then print the remaining time
        $taskId = $_POST['taskId'];

        //Fetch employees tasks
        $query_employees_tasks = "SELECT * FROM employees_tasks WHERE id = '$taskId'";
        $employees_tasks = $con->query($query_employees_tasks) or die ($con->error);
        $employee_task = $employees_tasks->fetch_assoc();

        echo $employee_task['remaining_time'];

    }

?>