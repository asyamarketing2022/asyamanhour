<?php include_once('connections/DBconnection.php'); ?>
<?php include_once 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

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

        $projectId = $_POST['projectId'];
        $userId = $_SESSION['UserId'];

        //Select All User Project
        $sql_task = "SELECT * FROM employees_tasks WHERE employee_id = $userId AND project_id = $projectId";
        $tasks = $con->query($sql_task) or die ($con->error);
        $task = $tasks->fetch_assoc();

        $option_tasks = '';

        do {

            echo "<option value='" .  $task['id'] . "'><strong>" . $task['task_title'] . "</strong> | " . $task['services'] . " | " . $task['phase_of_work'] . " </option>";

        } while($task = $tasks->fetch_assoc());

    }


?>