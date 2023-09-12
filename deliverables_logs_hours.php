<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['dateToday'])){

        $dateToday = $_POST['dateToday'];
        $userId = $_POST['userId'];

        $sql_employees_logs_hours = "SELECT * FROM employees_logs_hours WHERE employee_id = '$userId' AND date_logs = '$dateToday'";
        $employees_logs_hours = $con->query($sql_employees_logs_hours) or die ($con->error);
        $employee_logs = $employees_logs_hours->fetch_assoc();

        if($employees_logs_hours->num_rows != 0){

            echo $employee_logs['total_of_work_hours'];

        } else {

            echo '0';

        }

        
    }

?>