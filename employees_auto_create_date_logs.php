<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['calendarDate'])){

        $dateToday = $_POST['calendarDate'];

        $check = mysqli_query($con, "SELECT * FROM employees_logs_hours WHERE date_logs = '$dateToday'");
        $checkrows = mysqli_num_rows($check);

        if($checkrows == 0){

            $sql_employees = "SELECT * FROM registered_users";
            $employees = $con->query($sql_employees) or die ($con->error);
            $employee = $employees->fetch_assoc();

            // $check_num_employees = mysqli_num_rows($employees);
      
            do {

                $sql_insert_employees_logs = "INSERT INTO `employees_logs_hours`(`date_logs`,`employee_id`, `employee_name`) VALUES ('$dateToday', '". $employee['ID'] . "', '" . $employee['first_name'] . " " . $employee['last_name'] . "')";
                $con->query($sql_insert_employees_logs) or die ($con->error);
            
            } while($employee = $employees->fetch_assoc());

        }

    }

?>