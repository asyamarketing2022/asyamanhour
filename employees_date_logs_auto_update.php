<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

    $db = new DBconnection();
    $con = $db->connection();

    $query = "SELECT employee_id, employee_name, date, SUM(spend_hours) AS total_spend_hours FROM employees_updates_task GROUP BY employee_id, date";

    $result = $con->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $employeeId = $row['employee_id'];
            $date = $row['date'];
            $employeeName = $row['employee_name'];
            $totalSpendHours = $row['total_spend_hours'];
        
            $check_logs = mysqli_query($con, "SELECT * FROM employees_logs_hours WHERE date_logs = '$date' AND employee_id = '$employeeId'");
            $check_logs_rows = mysqli_num_rows($check_logs);

            if($check_logs_rows == 0){
    
                // Insert the total spent hours into employee_logs_hours table
                $insertQuery = "INSERT INTO employees_logs_hours (date_logs, employee_id, total_of_work_hours) 
                                VALUES ('$date', '$employeeId', '$totalSpendHours') 
                                ON DUPLICATE KEY UPDATE total_of_work_hours = '$totalSpendHours'";
            } else {

                $insertQuery = "UPDATE `employees_logs_hours` SET `total_of_work_hours` = '$totalSpendHours' WHERE employee_id = '$employeeId' AND date_logs = '$date'";
    
            }
          
            if ($con->query($insertQuery ) === FALSE) {
                echo "Error: " . $insertQuery . "<br>" . $con->error;
            }
        }

    } 

    // Close the connection
    $con->close();


?>