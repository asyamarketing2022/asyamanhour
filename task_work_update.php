<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['taskId'])){

        $projectId = $_POST['projectId'];
        $projectName = $_POST['projectName'];
        $services = $_POST['services'];
        $phase_of_work = $_POST['phase_of_work'];
        $taskId = $_POST['taskId'];
        $taskTitle = $_POST['taskTitle'];
        $dateToday = $_POST['dateToday'];
       
        $sql =  "INSERT INTO `employees_updates_task`(`project_id`, `project_name`, `services`, `phase_of_work`, `task_id`, `task_title`, `date`) VALUES ('$projectId', '$projectName', '$services', '$phase_of_work', '$taskId', '$taskTitle', '$dateToday')";

        $con->query($sql) or die ($con->error);

        $query_employee_work_update = "SELECT * FROM `employees_updates_task` WHERE task_id = '$taskId' ORDER BY id ASC";
        $employee_work_update = $con->query($query_employee_work_update) or die ($con->error);
        $row = $employee_work_update->fetch_assoc();

        $output = '';

        if($employee_work_update->num_rows != 0){

            $output .= "<tr class='taskUpdate_header'>
                            <th class='d-none'>Update Task Id</th>
                            <th>Updates</th>
                            <th>Date</th>
                            <th>Spend Hours</th>
                            <th></th>
                        </tr>";
            do {

            $output .= "<tr>
                            <td class='d-none'><span class='update_task_id'>". $row['id'] ."</span></td>
                            <td><input class='update_task_input' type='text' value='" . $row['task_update'] ."'></td>
                            <td><input class='update_task_date' type='date' value='" . $row['date'] . "'></td>
                            <td><input class='update_task_spendhours' type='number' value='" . $row['spend_hours'] . "'></td>
                            <td class='delete_update_task'>-</td>
                    </tr>";

            } while($row = $employee_work_update->fetch_assoc());

            $query_spend_total_hours = "SELECT * FROM `employees_tasks` WHERE id = $taskId";
            $spend_total_hours = $con->query($query_spend_total_hours) or die ($con->error);
            $total_hours = $spend_total_hours->fetch_assoc();

            $output .= "<tr>
                        <td><img class='add_newUpdate_btn' src='/img/add-icon.png' width='25'></td>
                        <td><button class='save_update_tasks'>Save</button></td>
                        <td>Total Hours:<span class='total_spend_hours'>" . $total_hours['total_spend_hours'] . "</span></td>
                        <td></td>
                    </tr>";
            
        }

        echo $output;

    }

?>