<?php include_once('connections/DBconnection.php'); ?>
<?php include_once 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    //Select Date and Query all user project
    if(isset($_POST['dateClick'])){

        $userId = $_SESSION['UserId'];
        $dateSelected = $_POST['dateClick'];

        //Select All User Project
        $sql_projects = "SELECT * FROM employees_tasks WHERE employee_id = $userId";
        $projects = $con->query($sql_projects) or die ($con->error);
        $project = $projects->fetch_assoc();

        $option_project = '';

        do {

            $project_array[] = $project['project_name'];
            $project_id_array[] = $project['project_id'];

        } while($project = $projects->fetch_assoc());

        //Filtered All Projects, remove same value in array
        $project_filter_array = array_unique($project_array);
        $project_id_filter_array = array_unique($project_id_array);

        $option_project .= "<option>Select Project:</option>";

        foreach($project_id_filter_array as $index => $project_info ){

            //Print All Projects
            $option_project .= "<option value='" .  $project_info . "'>" . $project_filter_array[$index] ."</option>";

        } 

        echo $option_project;
        
    } elseif(isset($_POST['projectId'])) {

        //Select project already and Query all user tasks
        $projectId = $_POST['projectId'];
        $userId = $_SESSION['UserId'];

        //Select All User Project
        $sql_task = "SELECT * FROM employees_tasks WHERE employee_id = $userId AND project_id = $projectId";
        $tasks = $con->query($sql_task) or die ($con->error);
        $task = $tasks->fetch_assoc();

        $option_task = "";

        $option_task .= "<option value='' disabled selected>Select Task:</option>";

        do {

            $option_task .= "<option value='" .  $task['id'] . "'><strong>" . $task['task_title'] . "</strong> | " . $task['services'] . " | " . $task['phase_of_work'] . " </option>";

        } while($task = $tasks->fetch_assoc());

        echo $option_task;

    } elseif(isset($_POST['selected_project_id'])) {

        $userId = $_SESSION['UserId'];
        $firstName = $_SESSION['UserLogin'];
        $lastName = $_SESSION['Userlname'];

        $projectId = $_POST['selected_project_id'];
        $taskId = $_POST['selected_task_id'];
        $selectedDate = $_POST['selectedDate'];
        $add_logs_task_update = $_POST['add_logs_task_update'];
        $add_logs_task_spend_hours = $_POST['add_logs_task_spend_hours'];

        //Query All employee task for selecting those details
        $sql_employee_task = "SELECT * FROM employees_tasks WHERE employee_id = $userId AND project_id = $projectId AND id = $taskId"; 
        $employee_tasks = $con->query($sql_employee_task) or die ($con->error);
        $employee_task = $employee_tasks->fetch_assoc();

        $project_name = $employee_task['project_name'];
        $task_title = $employee_task['task_title'];
        $services = $employee_task['services'];
        $phase_of_work = $employee_task['phase_of_work'];

        //Update employee task spend hours 
        $sql_employee_task_update = "SELECT * FROM employees_tasks WHERE employee_id = '$userId' AND id = '$taskId'";
        $employee_task_update = $con->query($sql_employee_task_update) or die ($con->error);
        $employeeTask = $employee_task_update->fetch_assoc();

        // Select total spend hours and add the new logs spend hours
        $update_total_spendhours = $add_logs_task_spend_hours + $employeeTask['total_spend_hours'];
        
        $sql_update_employees_task = "UPDATE `employees_tasks` SET `total_spend_hours` = '$update_total_spendhours' WHERE id = '$taskId'";

        $con->query($sql_update_employees_task) or die ($con->error);

        //Insert new task update
        $sql_new_logs = "INSERT INTO `employees_updates_task`(`project_id`, `project_name`, `services`, `phase_of_work`, `employee_id`, `employee_name`, `task_id`, `task_title`, `task_update`, `date`, `spend_hours`) VALUES ('$projectId', '$project_name', '$services', '$phase_of_work', '$userId', '$firstName $lastName', '$taskId', '$task_title', '$add_logs_task_update', '$selectedDate', '$add_logs_task_spend_hours')";

        $con->query($sql_new_logs) or die ($con->error);


        //Query all employee update logs
        $sql_employee_task_selected_date = "SELECT * FROM employees_updates_task WHERE employee_id = '$userId' AND date = '$selectedDate' ORDER BY id ASC";
        $employee_update_tasks = $con->query($sql_employee_task_selected_date) or die ($con->error);
        $employee_update_task = $employee_update_tasks->fetch_assoc();

        $output = '';

        if($employee_update_tasks->num_rows != 0){

            do {

                $output .= "<tr class='mylogs_update' id='". $employee_update_task['id'] ."'>
                    <td>". $employee_update_task['project_name'] ."</td>
                    <td>". $employee_update_task['services'] ."</td>
                    <td>". $employee_update_task['phase_of_work'] ."</td>
                    <td class='taskId' value='" . $employee_update_task['task_id'] . "'>". $employee_update_task['task_title'] ."</td>
                    <td>". $employee_update_task['task_update'] ."</td>
                    <td class='spendHours'>". $employee_update_task['spend_hours'] ."</td>
                    <td class='delete_update_task'>-</td>
                </tr>";

            } while($employee_update_task = $employee_update_tasks->fetch_assoc());

        }

        echo $output;

        //Call a function to add all spend hours and update the employees_logs_hours table
        include_once('employees_date_logs_auto_update.php');

    }


?>