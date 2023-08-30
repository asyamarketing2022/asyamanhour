<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

    $db = new DBconnection();
    $con = $db->connection();

    if(isset($_POST['spendhours'])){

        $spendhours = $_POST['spendhours'];
        // $employeeId = $_POST['employeeId'];
        $userId = $_SESSION['UserId'];
        $update_task_date = $_POST['update_task_date'];

        $sql_employees_logs = "SELECT * FROM employees_logs_hours WHERE employee_id = '$userId' AND date_logs = '$update_task_date'";
        $employees_logs = $con->query($sql_employees_logs) or die ($con->error);
        $employee_logs = $employees_logs->fetch_assoc();

        $employee_logs_update = $employee_logs['total_of_work_hours'] - $spendhours;
        // echo $employee_logs['total_of_work_hours'];
        
        $sql_employees_logs_update = "UPDATE `employees_logs_hours` SET `total_of_work_hours` = '$employee_logs_update' WHERE employee_id = '$userId' AND date_logs = '$update_task_date'";
        $con->query($sql_employees_logs_update) or die ($con->error);

        
    }

?>