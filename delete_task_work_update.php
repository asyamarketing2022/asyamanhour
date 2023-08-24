<?php include_once 'connections/DBconnection.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['update_task_id'])){

        $update_task_id = $_POST['update_task_id'];
        $taskId = $_POST['taskId'];
        $output = '';

        // Delete Employee Update Task
        $sql = "DELETE FROM employees_updates_task WHERE id = $update_task_id";
        $con->query($sql) or die($con->error);

        if($con->query($sql) === TRUE) {

            $query_employees_update_tasks = "SELECT * FROM `employees_updates_task` WHERE task_id = $taskId ORDER BY id ASC";
            $employee_update_tasks = $con->query($query_employees_update_tasks);
            $row = $employee_update_tasks->fetch_assoc();

            $output .= "<tr class='taskUpdate_header'>
                            <th class='d-none'>Update Task Id</th>
                            <th>Updates</th>
                            <th>Date</th>
                            <th>Spend Hours</th>
                            <th></th>
            
                        </tr>";

                do {

                    if($employee_update_tasks->num_rows != 0){

                    $output .= "<tr>
                            <td class='d-none'><span class='update_task_id'>". $row['id'] ."</span></td>
                            <td><input class='update_task_input' type='text' value='". $row['task_update'] ."'></td>
                            <td><input class='update_task_date' type='date' value='". $row['date'] ."'></td>
                            <td><input class='update_task_spendhours' type='number' value='". $row['spend_hours'] ."'></td>
                            <td class='delete_update_task'>-</td>
                        </tr>";

                    }

                } while($row = $employee_update_tasks->fetch_assoc());

                $output .= "<tr>
                            <td><img class='add_newUpdate_btn' src='img/add-icon.png' width='25'></td>
                            <td><button class='save_update_tasks'>Save</button></td>
                            <td>Total Hours:<span class='total_spend_hours'></span></td>
                            <td></td>
                        </tr>";

                echo $output;

        }


    } elseif(isset($_POST['total_spend_hours'])){

        $taskId = $_POST['taskId'];
        $total_spend_hours = $_POST['total_spend_hours'];
        $output = '';

        //Update the total spend hours when update task was deleted
        $sql_update = "UPDATE `employees_tasks` SET `total_spend_hours` = '$total_spend_hours' WHERE id = '$taskId'";

        if($con->query($sql_update) === TRUE) {

            $query_employees_update_tasks = "SELECT * FROM `employees_updates_task` WHERE task_id = $taskId ORDER BY id ASC";
            $employee_update_tasks = $con->query($query_employees_update_tasks);
            $row = $employee_update_tasks->fetch_assoc();

            $output .= "<tr class='taskUpdate_header'>
                            <th class='d-none'>Update Task Id</th>
                            <th>Updates</th>
                            <th>Date</th>
                            <th>Spend Hours</th>
                            <th></th>
            
                        </tr>";

                do {

                    if($employee_update_tasks->num_rows != 0){

                    $output .= "<tr>
                            <td class='d-none'><span class='update_task_id'>". $row['id'] ."</span></td>
                            <td><input class='update_task_input' type='text' value='". $row['task_update'] ."'></td>
                            <td><input class='update_task_date' type='date' value='". $row['date'] ."'></td>
                            <td><input class='update_task_spendhours' type='number' value='". $row['spend_hours'] ."'></td>
                            <td class='delete_update_task'>-</td>
                        </tr>";

                    }

                } while($row = $employee_update_tasks->fetch_assoc());

                $query_spend_total_hours = "SELECT * FROM `employees_tasks` WHERE id = $taskId";
                $spend_total_hours = $con->query($query_spend_total_hours) or die ($con->error);
                $total_hours = $spend_total_hours->fetch_assoc();

                $output .= "<tr>
                            <td><img class='add_newUpdate_btn' src='img/add-icon.png' width='25'></td>
                            <td><button class='save_update_tasks'>Save</button></td>
                            <td>Total Hours:<span class='total_spend_hours'>" . $total_hours['total_spend_hours'] . "</span></td>
                            <td></td>
                        </tr>";

                echo $output;

        }


    }


?>