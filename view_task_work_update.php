<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['taskId'])){

        $taskId = $_POST['taskId'];

        $query_employees_update_tasks = "SELECT * FROM `employees_updates_task` WHERE task_id = $taskId ORDER BY id DESC";
        $employee_update_tasks = $con->query($query_employees_update_tasks) or die ($con->error);
        $row = $employee_update_tasks->fetch_assoc();

        $output = '';

            $output .= "<tr class='taskUpdate_header'>
                            <th class='d-none'>Update Task Id</th>
                            <th>Updates</th>
                            <th>Date</th>
                            <th>Spend Hour</th>
                            <th></th>
                            <th></th>
                        </tr>";

            do {

                if($employee_update_tasks->num_rows != 0){

                $output .= "<tr>
                        <td class='d-none'><span class='update_task_id'>". $row['id'] ."</span></td>
                        <td><input type='text' value='". $row['task_update'] ."'></td>
                        <td><input type='date' value='". $row['date'] ."'></td>
                        <td><input type='number' value='". $row['spend_hour'] ."'></td>
                        <td>+</td>
                        <td class='delete_update_task'>-</td>
                    </tr>";

                }


            } while($row = $employee_update_tasks->fetch_assoc());

            $output .= "<tr>
                <td><img class='add_newUpdate_btn' src='/img/add-icon.png' width='25'></td>
            </tr>";

   

        echo $output;

    }


?>