<?php include_once('connections/DBconnection.php'); ?>
<?php include_once 'login.php'; ?>

<?php 

    $db = new DBconnection();
    $con = $db->connection();

    if(isset($_POST['taskUpdate_id'])){

        $taskUpdate_id = $_POST['taskUpdate_id'];
        $selectedDate = $_POST['selectedDate'];
        $userId = $_SESSION['UserId'];
        $spendhours = $_POST['spendhours'];
        $taskId = $_POST['taskId'];

        $output = '';

        //Delete the update task
        $sql_delete_logs = "DELETE FROM employees_updates_task WHERE id = $taskUpdate_id";
        $con->query($sql_delete_logs) or die ($con->error);

        if($con->query($sql_delete_logs) === TRUE) {

             //Select all remaining update tasks and print it
            $query_employees_logs_update_tasks = "SELECT * FROM `employees_updates_task` WHERE employee_id = '$userId' AND date = '$selectedDate' ORDER BY id ASC";
            $employee_logs_update_tasks = $con->query($query_employees_logs_update_tasks);
            $row = $employee_logs_update_tasks->fetch_assoc();

            if($employee_logs_update_tasks->num_rows != 0){

                do {
    
                    $output .= "<tr class='mylogs_update' id='". $row['id'] ."'>
                        <td>". $row['project_name'] ."</td>
                        <td>". $row['services'] ."</td>
                        <td>". $row['phase_of_work'] ."</td>
                        <td class='taskId' value='" . $row['task_id'] . "'>". $row['task_title'] ."</td>
                        <td>". $row['task_update'] ."</td>
                        <td class='spendHours'>". $row['spend_hours'] ."</td>
                        <td class='delete_update_task'>-</td>
                    </tr>";
    
                } while($row = $employee_logs_update_tasks->fetch_assoc());
    
            }

            echo $output;

            //Select all employees tasks
            $query_employees_task = "SELECT * FROM `employees_tasks` WHERE id = $taskId";
            $employees_task = $con->query($query_employees_task);
            $spend_hours = $employees_task->fetch_assoc();

            $remaining_spend_hours = $spend_hours['total_spend_hours'] - $spendhours;

            //Update employee total spend hours
            $sql_update_employee_task = "UPDATE `employees_tasks` SET `total_spend_hours` = '$remaining_spend_hours' WHERE id = '$taskId'";

            $con->query($sql_update_employee_task) or die ($con->error);

        }

    }